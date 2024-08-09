<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SaveSettingBlocksRequest;

use App\Http\Requests\Admin\SaveSettingEmailsRequest;
use App\Libraries\Database\Eloquent\Model;
use App\Models\Setting;
use App\Services\FeatureTagsService;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * @var Setting|Model
     */
    protected $instance;

    /**
     * SettingsController constructor.
     */
    public function __construct()
    {
        $this->instance = new Setting();
    }

    /**
     * Edit features settings.
     *
     * @return View|RedirectResponse
     */
    public function features(Request $request)
    {
        $this->authorize('features', Setting::class);

        $features_slugs = $request->except('_method', '_token');
        $q = $request->input('q');

        if ($request->isMethod('put')) {
            (new FeatureTagsService())->updateActiveStatus($features_slugs);

            return redirect()
                ->back()
                ->with('success', modelAction(Setting::class, 'success.updated'));
        }

        $features = (new FeatureTagsService())
            ->getFeatureTags($q)
            ->paginate(15);

        return view('admin.settings.features')
            ->with('instance', $this->instance)
            ->with('features', $features)
            ->with('type', Setting::class);
    }

    

    /**
     * Emails blocks.
     *
     * @return View|RedirectResponse
     *
     * @throws AuthorizationException
     * @throws Exception
     */
    public function blocks(Request $request)
    {
        return $this->handleSettings(
            $request,
            'blocks',
            SaveSettingBlocksRequest::class,
            [
                '*',
            ]
        );
    }

    /**
     * Handle all controller logic.
     *
     * @param Request $request
     * @param string  $target
     * @param string  $validator
     * @param array   $attributes
     * @param array   $files
     * @param bool    $breadcrumb
     *
     * @return View|RedirectResponse
     *
     * @throws AuthorizationException
     * @throws Exception
     */
    private function handleSettings($request, $target, $validator, $attributes, $files = [])
    {
        $this->authorize(Str::camel($target), Setting::class);

        if ($request->isMethod('put')) {
            $request = app($validator);

            $attributes = array_map(function ($item) use ($target) {
                if ($item === '*') {
                    return Str::snake(Str::camel($target));
                }

                return Str::snake(Str::camel($target)).'.'.$item;
            }, $attributes);

            $files = array_map(function ($item) use ($target) {
                return Str::snake(Str::camel($target)).'.'.$item;
            }, $files);

            $response = $this->storeSettings($request->only($attributes));

            $this->storeSingleAttachment($request, $files);

            return $response;
        }

        return view('admin.settings.'.$target)
            ->with('instance', $this->instance)
            ->with('type', Setting::class);
    }

    /**
     * Store group of settings.
     *
     * @param array $attributes
     *
     * @return RedirectResponse
     */
    protected function storeSettings($attributes)
    {
        foreach ((new Setting())->easyCast as $property => $cast) {
            $value = data_get($attributes, $property);

            if (is_null($value)) {
                continue;
            }

            if ($cast === 'date') {
                data_set($attributes, $property, Carbon::createFromFormat('d/m/Y H:i:s', $value));
            } elseif ($cast === 'strip_non_digits') {
                data_set($attributes, $property, preg_replace('/[^0-9]/', '', $value));
            }
        }

        settings($attributes);

        return redirect()
            ->back()
            ->with('success', modelAction(Setting::class, 'success.updated'));
    }

    /**
     * Store files.
     *
     * @param Request $request
     * @param array   $files
     *
     * @throws Exception
     */
    protected function storeSingleAttachment($request, $files)
    {
        foreach ($files as $index => $file) {
            $partials = explode('.', $file);
            $settingKey = array_shift($partials);
            $collection = $index;
            $filename = implode('.', [$settingKey, $index]);

            /** @var Setting $setting */
            $setting = settingsRaw($settingKey);

            if ($request->hasFile($filename) && $setting) {
                $setting->clearMediaCollection($collection);
                $setting->addMediaFromRequest($filename)
                    ->toMediaCollection($collection);
            }
        }
    }
}

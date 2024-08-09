<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\RedirectResponse;

class MediaController extends Controller
{
    /**
     * Delete one media file.
     *
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $instance = Media::query()
            ->find($id);

        $ability = get_class($instance->model) === "App\Models\Setting"
            ? data_get($instance->model, 'meta_key')
            : 'update';

        $this->authorize($ability, $instance->model);

        $instance->delete();

        return back()->with('success', __('Arquivo excluído com sucesso'));
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use Illuminate\View\View;
use App\Services\FootballerService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Repositories\FootballerRepository;
use App\Http\Requests\Frontend\UpdateProfileRequest;
use App\Http\Requests\Frontend\UpdateProfileAvatarRequest;

class ProfileController extends Controller
{
    /**
     * Show profile info
     *
     * @return View
     */
    public function show()
    {
        return redirect()->route('web.frontend.profiles.edit');
    }

    /**
     * Show profile edit form.
     *
     * @return View
     */
    public function edit()
    {
        $footballer = footballer();

        $address = $footballer->address;
        $paymentProfiles = $footballer->paymentProfiles()
            ->latest()
            ->get()
            ->unique('serial');

        $payment_profiles_amount = $footballer->paymentProfiles()->count();

        return view('frontend.profiles.edit')
            ->with('footballer', $footballer)
            ->with('address', $address)
            ->with('paymentProfiles', $paymentProfiles)
            ->with('payment_profiles_amount', $payment_profiles_amount);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfileRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateProfileRequest $request)
    {
        $footballer = footballer();

        $repository = new FootballerRepository();

        if ($footballer = $repository->update($footballer, $request->all())) {
            if ($redirectTo = request('redirect_url')) {
                return redirect($redirectTo);
            }
            return back()
                ->with('success', __('Seu perfil foi atualizado'));
        }

        return back()
            ->withInput()
            ->with('warning', __('Não foi possível atualizar seu perfil'));
    }

    /**
     * Show profile edit form.
     *
     * @return View
     */
    public function editAvatar()
    {
        $footballer = footballer();
        $profile = $footballer->profile;

        return view('frontend.profiles.edit-avatar')
            ->with('footballer', $footballer)
            ->with('profile', $profile);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfileAvatarRequest $request
     * @return RedirectResponse
     */
    public function updateAvatar(UpdateProfileAvatarRequest $request)
    {
        $footballer = footballer();

        $repository = new FootballerRepository();
 
        try {
            $repository->updateAvatar($footballer, $request->image);
            return response()->json(['message' => 'Sua foto foi atualizada.'], 200);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['message' => 'Não foi possível atualizar sua foto.'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    /**
     * Show profile edit form.
     *
     * @return View
     */
    public function edit()
    {
        $footballer = footballer();
        $preference = $footballer->preference;

        $positions = [
            'Atacante',
            'Goleiro',
            'Lateral',
            'Volante',
            'Zagueiro',
            'Meio-campista'
        ];

        $dominantFeet = [
            'Direito',
            'Esquerdo',
            'Ambos'
        ];

        return view('frontend.preferences.edit')
            ->with('footballer', $footballer)
            ->with('positions', $positions)
            ->with('dominantFeet', $dominantFeet)
            ->with('preference', $preference);
    }

    /**
     * Update profile preferences.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $footballer = footballer();
        $preference = $footballer->preference;

        $validatedData = $request->validate([
            'position' => 'required|string|in:Atacante,Goleiro,Lateral,Volante,Zagueiro,Meio-campista',
            'dominant_foot' => 'required|string|in:Direito,Esquerdo,Ambos',
        ]);

        $preference->position = $validatedData['position'];
        $preference->dominant_foot = $validatedData['dominant_foot'];
        $preference->save();

        return redirect()->route('frontend.preferences.edit')
            ->with('success', 'Preferências atualizadas com sucesso.');
    }
}

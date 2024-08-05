<?php

namespace App\Http\Controllers;

use App\Http\Requests\Information\StoreInformationRequest;
use App\Http\Requests\Insurance\BuyInsuranceRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Information;
use App\Models\Province;
use App\Models\UserInsurance;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function createInformation(Request $request): Response
    {
        $provinces = Province::all();

        return Inertia::render('Profile/SetInformation', compact('provinces'));
    }

    public function userInformation(Request $request)
    {
        $user = auth()->user();
        $information = $user->informations;

        return Inertia::render('Profile/UserInformation', compact('information'));
    }

    public function storeInformation(StoreInformationRequest $request): RedirectResponse
    {
        $inputs = $request->validated();
        auth()->user()->informations()->create($inputs);

        return Redirect::route('information.lists');
    }

    public function updateInformation(StoreInformationRequest $request, Information $information): RedirectResponse
    {
        $inputs = $request->validated();
        $information->update($inputs);

        return Redirect::route('information.lists');
    }

    public function informationLists(Request $request)
    {
        $user = auth()->user();
        if (count($user->informations) === 0) {
            return Redirect::route('information.create');
        }

        $informations = $user->informations()->with('province')->get();

        return Inertia::render('Profile/InformationLists', compact('informations'));
    }

    public function userInsurance(Request $request)
    {
        $user = auth()->user();
        $insurances = $user->insurances()->with('insurance')->get();

        return Inertia::render('Profile/Insurance', compact('insurances'));
    }

    public function buyInsurance(BuyInsuranceRequest $request)
    {
        $user = auth()->user();

        $information = Information::find($request->information_id);
        if ($information->user_id != $user->id) {
            return Redirect::route('home');
        }

        foreach ($request->insurances as $key => $value) {
            UserInsurance::create([
                'user_id' => $user->id,
                'insurance_id' => $value,
                'information_id' => $request->information_id,
            ]);
        }
        return to_route('user.insurances');
    }
}
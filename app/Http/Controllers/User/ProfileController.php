<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Ramsey\Uuid\Uuid;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles_count = Profile::whereUserId(auth()->id())->count();

        if ($profiles_count === 0) {

            $user = auth()->user();
            $username = $user->username;
            $usernameExists = Profile::whereUsername($user->username)->count();
            if ($usernameExists) $username = $username . rand(100000, 999999);

            // check if email exists
            $email = $user->email;
            $emailExists = Profile::whereEmail($user->email)->count();
            if ($emailExists) $email = $email . rand(100000, 999999);

            $profile = Profile::query()->create([
                'uuid' => Uuid::uuid4(),
                'user_id' => $user->id,
                'name' => $user->name,
                'username' => $username,
                'email' => $email
            ]);

            $user->profile_id = $profile->id;
            $user->save();
        }

        $profiles = Profile::whereUserId(auth()->id())->paginate();

        return Inertia::render("User/Profiles/Index", compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profile = new Profile();
        $profile->name = auth()->user()->name;

        return Inertia::render("User/Profiles/Form", compact('profile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileRequest $request)
    {
        $profile = Profile::query()->create($request->validated());
        return redirect(route('user.profiles.index'))->with('success', __('Profile created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        return Inertia::render("User/Profiles/Form", compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        return Inertia::render("User/Profiles/Form", compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, Profile $profile)
    {
        $profile->update($request->validated());
        return redirect(route('user.profiles.index'))->with('success', __('Profile updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        // @TODO delete related data

        $profile->delete();
        return redirect(route('user.profiles.index'))->with('success', __('Profile deleted successfull'));
    }
}

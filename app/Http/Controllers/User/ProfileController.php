<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Ramsey\Uuid\Uuid;

use function PHPUnit\Framework\isEmpty;

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
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $profile = Profile::query()->create($data);
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
        $data = $request->validated();

        if (is_null($data['cover']) or isEmpty($data['cover'])) unset($data['cover']);
        if (is_null($data['avatar']) or isEmpty($data['avatar'])) unset($data['avatar']);

        // Delete old avatar if a new one is uploaded
        if ($request->hasFile('avatar')) {
            if ($profile->avatar && Storage::disk('public')->exists($profile->avatar)) {
                Storage::disk('public')->delete($profile->avatar);
            }
            
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        } else if ($request->boolean('delete_avatar')) {
            if ($profile->avatar && Storage::disk('public')->exists($profile->avatar)) {
                Storage::disk('public')->delete($profile->avatar);
            }

            $data['avatar'] = null;
        }

        // Delete old cover if a new one is uploaded
        if ($request->hasFile('cover')) {
            if ($profile->cover && Storage::disk('public')->exists($profile->cover)) {
                Storage::disk('public')->delete($profile->cover);
            }

            $data['cover'] = $request->file('cover')->store('covers', 'public');
        } else if ($request->boolean('delete_cover')) {
            if ($profile->cover && Storage::disk('public')->exists($profile->cover)) {
                Storage::disk('public')->delete($profile->cover);
            }
            $data['cover'] = null;
        }

        $profile->update($data);
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

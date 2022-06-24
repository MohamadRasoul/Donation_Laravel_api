<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{

    public function index()
    {
        // Get Data
        $users = User::latest()->get();

        // Return Response
        return response()->success(
            'this is all Users',
            [
                "users" => UserResource::collection($users),
            ]
        );
    }


    public function store(Request $request)
    {

        // Data Validate
        $data = $request->validate([
            'name'          => 'required',
        ]);


        // Store User
        $user = User::create($data);


        // Add Image to User
        $user
            ->addMediaFromRequest('image')
            ->toMediaCollection('User');

        // Return Response
        return response()->success(
            'user is added success',
            [
                "user" => new UserResource($user),
            ]
        );
    }


    public function show(User $user)
    {
        // Return Response
        return response()->success(
            'this is your user',
            [
                "user" => new UserResource($user),
            ]
        );
    }

    public function update(Request $request, User $user)
    {
        // Data Validate
        $data = $request->validate([
            'name'          => 'nullable',
        ]);

        // Update User
        $user->update($data);


        // Edit Image for  User if exist
        $request->image &&
            $user
                ->addMediaFromRequest('image')
                ->toMediaCollection('User');
        };


        // Return Response
        return response()->success(
            'user is updated success',
            [
                "user" => new UserResource($user),
            ]
        );
    }

    public function destroy(User $user)
    {
        // Delete User
        $user->delete();

        // Return Response
        return response()->success('user is deleted success');
    }
}

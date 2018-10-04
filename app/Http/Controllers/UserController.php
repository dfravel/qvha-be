<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Log;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return UserResource::collection(User::all());
    }


    public function store(Request $request)
    {
        // confirm that the required fields are included
        $validator = $this->validateUser($request->all());

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'is_admin_login' => $request->get('is_admin'),
        ]);

        $data = [
            'data' => new UserResource($user),
            'status' => (bool)$user,
            'message' => $user ? 'User Created!' : 'Error Creating User',
        ];

        return response()->json($data);
    }


    public function show(User $user)
    {
        return new UserResource($user);
    }



    public function update(Request $request, User $user)
    {
        $validator = $this->validateUpdateUser($request->all(), $user->id);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user->fill($request->all())->save();

        $data = [
            'data' => new UserResource($user),
            'status' => (bool)$user,
            'message' => $user ? 'User Updated!' : 'Error Updating User',
        ];

        return response()->json($data);
    }


    public function destroy(User $user)
    {
        $user->delete();

        $data = [
            'status' => (bool)$user,
            'message' => $user ? 'User Deleted!' : 'Error Deleting User',
        ];

        return response()->json($data, 200);
    }

    private function validateUser($data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

    private function validateUpdateUser($data, $id)
    {
        return Validator::make($data, [
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'password' => 'sometimes|required|string|min:6',
            'email' => [
                'sometimes',
                'email',
                'required',
                Rule::unique('users')->ignore($id),
            ],
        ]);
    }
}

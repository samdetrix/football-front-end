<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //


    public function registerUser(Request $request)
    {
        try {
            // Check if user with the provided email already exists
            $existingUser = User::where('email', $request->email)->first();

            if ($existingUser) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User already exists',
                    'data' => null,
                ], 409);
            }

            // Validation after checking for existing user
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users',
                'phone' => 'nullable|string',
                'role_id' => 'required|exists:roles,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'data' => $validator->errors(),
                ], 422);
            }

            // Create a new user
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt('password'),
                'status' => 'active',
            ]);

            $user->save();

            // Attach role to the user
            $user->roles()->attach($request->role_id);

            // Lazy load roles
            $userWithRoles = User::with('roles')->find($user->id);

            return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully',
                'data' => [
                    'user' => $userWithRoles,
                ],
            ], 201);

        } catch (QueryException $exception) {
            $errorCode = $exception->errorInfo[1];

            if ($errorCode == 1062) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Duplicate entry. User with this email or phone number already exists.',
                    'data' => null,
                ], 409);
            }

            // Extract the specific database error message
            $errorMessage = $exception->getMessage();

            return response()->json([
                'status' => 'error',
                'message' => "Database error: $errorMessage",
                'data' => null,
            ], 500);
        }
    }




    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'data' => $validator->errors(),
            ]);
        }

        if ($token = JWTAuth::attempt($validator->validated())) {
            $user = auth()->user();
            // Lazy load roles
            $userWithRoles = User::with('roles')->find($user->id);

            return response()->json([
                'status' => 'success',
                'message' => 'User signed in successfully',
                'data' => [
                    'user' => $userWithRoles,
                    'token' => $token,
                ],
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid credentials',
            'data' => null,
        ]);
    }

    public function getUsers($user_id = null)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        if (is_null($user_id)) {
            $users = User::latest()->get();

            if ($users->isNotEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Users Fetched Successfully',
                    'data' => $users,
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No users found',
                    'data' => null,
                ]);
            }
        } else {
            $user = User::find($user_id);

            if ($user) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'User Fetched Successfully',
                    'data' => $user,
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found',
                    'data' => null,
                ], 404);
            }
        }
    }
    public function deleteUser($user_id)
    {
        $authenticatedUser = auth()->user();

        if (!$authenticatedUser) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        $userToDelete = User::find($user_id);

        if ($userToDelete) {
            $userToDelete->update(['status' => 'dormant']);

            Artisan::call('schedule:run');

            return response()->json([
                'status' => 'success',
                'message' => 'Your account will be deleted after 30 days. Log in again within this period to cancel the deletion.',
                'data' => null,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User does not exist',
                'data' => null,
            ]);
        }
    }
    public function logout()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (\Exception $e) {
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User logged out successfully',
            'data' => null,
        ]);
    }


    public function updateUser(Request $request, $id)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized',
                    'data' => null,
                ], 401);
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email,' . $id,
                'phone' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'data' => $validator->errors(),
                ], 422);
            }

            $user = User::find($id);
            // dd($user);
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found',
                    'data' => null,
                ], 404);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;

            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'User details updated successfully',
                'data' => [
                    'user' => $user
                ],
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => 'User update failed',
                'data' => null,
            ], 422);
        }
    }
    public function changePassword(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
                'data' => null,
            ], 401);
        }

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
        ]);

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Current password is incorrect',
                'data' => null,
            ]);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password changed successfully',
            'data' => null,
        ]);
    }

    public function resetPassword(Request $request)
    {
        // dd("i am here");
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);
            $userToReset = User::where('email', $request->input('email'))->firstOrFail();

            $userToReset->password = Hash::make('password');
            $userToReset->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password reset successfully. Your new password is "password".',
                'data' => null,
            ]);
        } catch (ValidationException $validationException) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error. Please check your input.',
                'data' => $validationException->errors(),
            ], 422);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'status' => 'error',
                'message' => 'User with the provided email not found.',
                'data' => null,
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred: ' . $exception->getMessage(),
                'data' => null,
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\{User};
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::with('role')->latest()->get();

        return response()->json([
            'message' =>$users->isEmpty() ? 'No user found' : 'Users retrieved successfully',
            'data' => $users
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
         $validated = $request->validated();
         
         $file = $request->file('profile_image');
        
        try {

            $user = User::createUser($validated,$file);

            return response()->json([
                'message' => 'User created successfully',
                'data' => $user
            ], 201);

        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Failed to create user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

   
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;

    /**
     * Create a new controller instance.
     *
     * @param UserService $userService
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $this->userService->store($data);

        if (!$user) {
            return response()->json(
                [
                    'status'  => 'failed',
                    'message' => __('messages.user.created_failed'),
                    'data'    => [
                        'user'  => '',
                        'token' => ''
                    ]
                ],
                422
            );
        }

        // Generate token for API authentication
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(
            [
                'status'  => 'success',
                'message' => __('messages.user.created'),
                'data'    => [
                    'user'  => new UserResource($user),
                    'token' => $token
                ]
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Return the current user.
     *
     * @param Request $request
     *
     * @return UserResource
     */
    public function currentUser(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}

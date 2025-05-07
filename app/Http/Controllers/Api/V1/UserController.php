<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
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
    public function index(): JsonResponse
    {
        // Get users from service
        $users = $this->userService->getAllUsers();

        if (!$users) {
            return response()->json(
                [
                    'status'  => __('messages.status_error'),
                    'message' => __('messages.user.not_found_users')
                ],
                500
            );
        }

        // Return users as a resource collection
        $userCollection = new UserResourceCollection($users);

        return response()->json(
            [
                'status' => $userCollection->hasProcessingErrors() ? __('messages.status_error') :
                    __('messages.status_success'),
                'data'   => [
                    'users' => $userCollection
                ],
                'meta'   => [
                    'current_page'  => $users->currentPage(),
                    'last_page'     => $users->lastPage(),
                    'per_page'      => $users->perPage(),
                    'total'         => $users->total(),
                    'has_errors'    => $userCollection->hasProcessingErrors(),
                    'error_message' => $userCollection->hasProcessingErrors() ?
                        __('messages.resource.collection_error') : null
                ]
            ],
            200
        );

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
                'status'  => __('messages.status_success'),
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
     * Handles both PUT (full update) and PATCH (partial update).
     */
    public function update(UserRequest $request, string $id)
    {
        $isAdmin = $request->user()->isAdmin();

        // Get validated data
        $data = $request->validated();

        // If not admin, restrict fields
        if (!$isAdmin) {
            $data = array_diff_key(
                $data,
                array_flip(
                    [
                        'email_verified_at',
                        'is_admin',
                        'remember_token',
                        'created_at',
                        'updated_at'
                    ]
                )
            );
        }

        // Update user via the service
        $user = $this->userService->update($id, $data);

        if (!$user) {
            return response()->json(
                [
                    'status'  => __(
                        'messages.status_error'
                    ),
                    'message' => __(
                        'messages.user.update_failed'
                    )
                ],
                422
            );
        }

        return response()->json(
            [
                'status'  => __(
                    'messages.status_success'
                ),
                'message' => __(
                    'messages.user.updated'
                ),
                'data'    => [
                    'user' => new UserResource(
                        $user
                    )
                ]
            ],
            200
        );
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

    /**
     * Log in a user and return a token
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $this->userService->getByEmailAndPassword($data['email'], $data['password']);

        if (!$user) {
            return response()->json(
                [
                    'status'  => __('messages.status_error'),
                    'message' => __('messages.user.account_not_found'),
                    'data'    => null
                ],
                401
            );
        }

        // Revoke any existing tokens for this user
        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(
            [
                'status'  => __('messages.status_success'),
                'message' => __('messages.user.logged_in'),
                'data'    => [
                    'user'  => new UserResource(
                        $user
                    ),
                    'token' => $token
                ]
            ],
            200
        );
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserStoreRequest;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
    public function index(): View|Application|Factory
    {
        // Get users from service
        $users = $this->userService->getAllUsers();

        if (!$users) {
            abort(404);
        }

        /** @var view-string $viewPath */
        $viewPath = 'admin.users.index';

        return view($viewPath, ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory
    {
        /** @var view-string $viewPath */
        $viewPath = 'users.create';

        return view($viewPath);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = $this->userService->store($data);

        if (!$user) {
            return redirect()->back()->withInput()->with('error', __('messages.user.account_store_failed'));
        }

        auth()->login($user);

        if (Gate::allows('admin')) {
            return redirect()->route('admin.users.index');
        }

        return redirect()->route('web.users.show', ['id' => auth()->id()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int|null|string $id): View|Application|Factory
    {
        $user = $this->userService->getById($id);

        if (!$user) {
            abort(404);
        }

        /** @var view-string $viewPath */
        $viewPath = 'users.show';

        return view($viewPath, ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int|null|string $id): View|Application|Factory|RedirectResponse
    {
        $user = $this->userService->getById($id);

        if (!$user) {
            return redirect()->back()->with('error', __('messages.user.not_found_users'));
        }

        $address = $user->address;
        $contacts = $user->contacts;
        $files = $user->files;

        /** @var view-string $viewPath */
        $viewPath = 'users.edit';

        return view($viewPath, ['user' => $user, 'address' => $address, 'contacts' => $contacts, 'files' => $files]);
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
            return redirect()->back()->withInput()->with(
                'error',
                __(
                    'messages.user.update_failed'
                )
            );
        }

        if ($isAdmin) {
            return redirect()->route('web.admin.users.index')->with(
                'success',
                __('messages.user.updated')
            );
        } else {
            return redirect()->route('web.users.show', ['id' => $id])->with(
                'success',
                __('messages.user.updated')
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Log the user in to the application.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = $this->userService->getByEmailAndPassword($data['email'], $data['password']);

        if (!$user) {
            return redirect()->back()->withInput()->with('error', __('messages.user.account_not_found'));
        }

        auth()->login($user);

        if (Gate::allows('admin')) {
            return redirect()->route('web.admin.users.index');
        }

        return redirect()->route('web.users.show', ['id' => auth()->id()]);
    }

    /**
     * Direct users on the home page.
     */
    public function home(): View|Application|Factory|RedirectResponse
    {
        if (!auth()->check()) {
            return view('users.login');
        }

        if (Gate::allows('admin')) {
            return redirect()->route('web.admin.users.index');
        }

        return redirect()->route('web.users.show', ['id' => auth()->id()]);
    }
}

<?php
/**
 * @file messages.php
 *
 * @author Gaspare Joubert
 * @date 02/05/2025 20:48
 *
 */

return [
    'welcome'          => 'Welcome to our application',
    'app_name'         => 'Fire5',
    'login'            => 'Login',
    'register'         => 'Register',
    'logout'           => 'Logout',
    'email'            => 'Email Address',
    'password'         => 'Password',
    'remember_me'      => 'Remember Me',
    'forgot_password'  => 'Forgot Your Password?',
    'name'             => 'Name',
    'confirm_password' => 'Confirm Password',

    // User Controller Messages
    'user'             => [
        'created'                      => 'User created successfully',
        'updated'                      => 'User updated successfully',
        'deleted'                      => 'User deleted successfully',
        'not_found'                    => 'User not found',
        'account_successfully_created' => 'Your account has been created successfully!',
    ],

    // Validation Messages
    'validation'       => [
        'required'  => 'The :attribute field is required',
        'email'     => 'The :attribute must be a valid email address',
        'min'       => 'The :attribute must be at least :min characters',
        'confirmed' => 'The :attribute confirmation does not match',
    ],
];

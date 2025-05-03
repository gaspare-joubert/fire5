<?php
/**
 * @file messages.php
 *
 * @author Gaspare Joubert
 * @date 02/05/2025 20:48
 *
 */

return [
    'welcome'                  => 'Welcome to our application',
    'app_name'                 => 'Fire5',
    'login'                    => 'Login',
    'register'                 => 'Register',
    'logout'                   => 'Logout',
    'email'                    => 'Email Address',
    'password'                 => 'Password',
    'remember_me'              => 'Remember Me',
    'forgot_password'          => 'Forgot Your Password?',
    'name'                     => 'Name',
    'confirm_password'         => 'Confirm Password',
    'your_name'                => 'Your Name',
    'name_placeholder'         => 'Enter your name',
    'your_email'               => 'Your Email',
    'email_placeholder'        => 'name@example.com',
    'password_placeholder'     => '••••••••',
    'login_here'               => 'Login Here',
    'required_field_indicator' => '*',
    'login_to_your_account'    => 'Login to your account',

    // User Controller Messages
    'user'                     => [
        'created'                      => 'User created successfully',
        'updated'                      => 'User updated successfully',
        'deleted'                      => 'User deleted successfully',
        'not_found'                    => 'User not found',
        'account_successfully_created' => 'Your account has been created successfully!',
        'account_create'               => 'Create an account',
        'account_already'              => 'Already have an account?',
        'account_details'              => 'Account Details',
        'account_edit'                 => 'Edit Account',
        'account_not_already'          => 'Don’t have an account yet?',
        'account_store_failed'         => 'Account creation failed',
        'account_not_found'            => 'Account not found',
        'created_failed'               => 'User not created',
    ],

    // Validation Messages
    'validation'               => [
        'required'  => 'The :attribute field is required',
        'email'     => 'The :attribute must be a valid email address',
        'min'       => 'The :attribute must be at least :min characters',
        'confirmed' => 'The :attribute confirmation does not match',
    ],
];

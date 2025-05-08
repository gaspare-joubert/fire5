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
    'status_error'             => 'error',
    'status_success'           => 'success',
    'actions'                  => 'Actions',
    'view'                     => 'View',
    'edit'                     => 'Edit',
    'save'                     => 'Save',
    'cancel'                   => 'Cancel',
    'address_line_1'           => 'Address Line 1',
    'address_line_2'           => 'Address Line 2 (Optional)',
    'city'                     => 'City',
    'postcode'                 => 'Postcode',
    'contact_number'           => 'Contact Number',
    'contacts'                 => 'Contacts',
    'mime_type'                => 'File Type',
    'size'                     => 'Size',
    'files'                    => 'Files',
    'bytes'                    => 'bytes',
    'notification'             => 'Notification',
    'close_modal'              => 'Close modal',
    'ok'                       => 'OK',
    'modal_error_title'        => 'Error',
    'modal_success_title'      => 'Success',
    'default_error_message'    => 'An error occurred while processing your request.',
    'delete'                   => 'Delete',
    'modal_init_success'       => 'Modal initialized successfully',
    'modal_init_error'         => 'Error initializing modal:',
    'modal_deleting'           => 'Deleting...',

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
        'account_not_already'          => 'Don\'t have an account yet?',
        'account_store_failed'         => 'Account creation failed',
        'account_not_found'            => 'Account not found',
        'created_failed'               => 'User not created',
        'logged_in'                    => 'User logged in successfully',
        'access_unauthorized'          => 'Unauthorized access',
        'not_found_users'              => 'Failed to retrieve users',
        'action_unauthorized'          => 'Unauthorized action',
        'all_users'                    => 'Users',
        'update_failed'                => 'User update failed',
    ],

    // Validation Messages
    'validation'               => [
        'required'  => 'The :attribute field is required',
        'email'     => 'The :attribute must be a valid email address',
        'min'       => 'The :attribute must be at least :min characters',
        'confirmed' => 'The :attribute confirmation does not match',
        'files'     => [
            'required'      => 'Please select at least one file to upload.',
            'array'         => 'An error occurred while uploading the file.',
            'item_required' => 'An error occurred while uploading the file.',
            'file'          => 'Each uploaded item must be a valid file.',
            'mimetypes'     => 'Files must be PDF, JPEG, Text, or PNG format only.',
            'max'           => 'Files cannot be larger than 10MB.',
        ],
    ],

    // File Controller Messages
    'file'                     => [
        'created'         => 'File created successfully',
        'updated'         => 'File updated successfully',
        'deleted'         => 'File deleted successfully',
        'not_found'       => 'File not found',
        'store_failed'    => 'File creation failed',
        'store_success'   => 'File uploaded successfully',
        'not_found_files' => 'Failed to retrieve files',
        'upload'          => 'Upload File',
        'upload_button'   => 'Upload',
        'upload_error'    => 'An error occurred while uploading the file',
        'allowed_types'   => 'PDF, TEXT, DOC, DOCX, XLS, XLSX up to 10MB',
    ],

    // Resource Processing Messages
    'resource'                 => [
        'address_load_error'  => 'Unable to load address data',
        'process_error'       => 'Error processing resource',
        'collection_error'    => 'Some resources could not be processed',
        'contacts_load_error' => 'Unable to load contacts data',
    ],

    // Breadcrumbs
    'breadcrumbs' => [
        'home' => 'Home',
        'users' => 'Users',
        'profile' => 'Profile',
        'edit_user' => 'Edit User',
        'user_details' => 'User Details',
    ],
];

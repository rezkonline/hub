<?php

return [
    'plural' => 'Users',
    'singular' => 'User',
    'empty' => 'There are no users',
    'select' => 'Select User',
    'select-type' => 'All',
    'perPage' => 'Count Users Per Page',
    'wallet' => 'Wallet',
    'actions' => [
        'list' => 'List Users',
        'show' => 'Show User',
        'create' => 'Create a new user',
        'edit' => 'Edit User',
        'delete' => 'Delete User',
        'save' => 'Save',
        'filter' => 'Filter',
    ],
    'messages' => [
        'created' => 'The user has been created successfully.',
        'updated' => 'The user has been updated successfully.',
        'deleted' => 'The user has been deleted successfully.',
    ],
    'attributes' => [
        'name' => 'Name',
        'email' =>  'Email',
        'phone' => 'Phone',
        'password' => 'Password',
        'password_confirmation' => 'Password Confirmation',
        'type' => 'User Type',
        'avatar' => 'Avatar',
        'strategy_plan' => 'Strategy Plan',
        'strategy_plan_file' => 'Strategy Plan File',
        'city_id' => 'City',
        'manager_id' => 'Account Manager',
        'employee_id' => 'Employee',
    ],
    'types' => [
        \App\Models\User::SUPERVISOR_TYPE => 'Account Manager',
        \App\Models\User::ADMIN_TYPE => 'Admin',
        \App\Models\User::EMPLOYEE_TYPE => 'Employee',
        \App\Models\User::CUSTOMER_TYPE => 'Customer',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the user ?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
        'attach' => [
            'title' => 'Attach :name',
            'confirm' => 'Attach',
            'cancel' => 'Cancel',
        ],
        'detach' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to detach this package from this user ?',
            'confirm' => 'Detach',
            'cancel' => 'Cancel',
        ],
    ],
];

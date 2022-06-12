<?php

return [
    'plural' => 'Users',
    'singular' => 'User',
    'empty' => 'There are no users',
    'select' => 'Select User',
    'select-type' => 'All',
    'perPage' => 'Count Users Per Page',
    'wallet' => 'Wallet',
    'since' => 'Since :date',
    'profile' => 'Profile',
    'actions' => [
        'filter' => 'Filter',
    ],
    'alerts' => [
        'registered' => 'Thank you for your registration. We kindly ask you to speak with the account manager through the chat in, to set up your account based on your requirements.'
    ],
    'types' => [
        \App\Models\User::SUPERVISOR_TYPE => 'Account Manager',
        \App\Models\User::ADMIN_TYPE => 'Admin',
        \App\Models\User::EMPLOYEE_TYPE => 'Employee',
        \App\Models\User::CUSTOMER_TYPE => 'Customer',
    ],
];

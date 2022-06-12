<?php

return [
    'plural' => 'Admins',
    'singular' => 'Admin',
    'empty' => 'There are no admins',
    'select' => 'Select admin',
    'select-type' => 'All',
    'perPage' => 'Admins per page',
    'actions' => [
        'list' => 'List admins',
        'show' => 'Show',
        'create' => 'Create new admin',
        'edit' => 'Edit Admin',
        'delete' => 'Remove Admin',
        'save' => 'Save',
        'filter' => 'Filter',
    ],
    'messages' => [
        'created' => 'Admin has been created successfully .',
        'updated' => 'Admin has been updated successfully .',
        'deleted' => 'Admin has been deleted successfully .',
    ],
    'attributes' => [
        'name' => 'Name',
        'email' =>  'Email',
        'phone' => 'Phone',
        'password' => 'Password',
        'password_confirmation' => 'Password confirmation',
        'avatar' => 'Avatar',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'Alert !',
            'info' => 'Are you sure you want to delete this admin ?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
    ],
];

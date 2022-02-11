<?php

return [
    'plural' => 'Schedules',
    'singular' => 'Schedule',
    'empty' => 'There are no schedules',
    'perPage' => 'Count Schedules Per Page',
    'actions' => [
        'list' => 'List Schedules',
        'show' => 'Show Schedules',
        'create' => 'Create a new schedule',
        'edit' => 'Edit schedule',
        'delete' => 'Delete schedule',
        'save' => 'Save',
        'filter' => 'Filter',
    ],
    'messages' => [
        'created' => 'The schedule has been created successfully.',
        'updated' => 'The schedule has been updated successfully.',
        'deleted' => 'The schedule has been deleted successfully.',
    ],
    'attributes' => [
        'name' => 'Schedule name',
        'description' => 'Description',
        'status' => 'Status',
        'customer_id' => 'Customer',
    ],
    'types' => [
        \App\Models\Schedule::COMPLETED_STATUS => 'Completed',
        \App\Models\Schedule::ONGOING_STATUS => 'Ongoing',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the package ?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
    ],
];

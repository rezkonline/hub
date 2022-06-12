<?php

return [
    'plural' => 'Tasks',
    'singular' => 'Task',
    'empty' => 'There are no tasks',
    'select' => 'Select a task',
    'perPage' => 'Count Tasks Per Page',
    'actions' => [
        'list' => 'List Tasks',
        'show' => 'Show Tasks',
        'create' => 'Create a new task',
        'edit' => 'Edit task',
        'delete' => 'Delete task',
        'save' => 'Save',
        'filter' => 'Filter',
    ],
    'messages' => [
        'created' => 'The task has been created successfully.',
        'updated' => 'The task has been updated successfully.',
        'deleted' => 'The task has been deleted successfully.',
    ],
    'attributes' => [
        'name' => 'Task name',
        'description' => 'Description',
        'status' => 'Status',
        'customer_id' => 'Customer',
        'attachments' => 'Attachments',
        'created_at' => 'Created At',
    ],
    'types' => [
        \App\Models\Task::COMPLETED_STATUS => 'Completed',
        \App\Models\Task::ONGOING_STATUS => 'Ongoing',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the task ?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
    ],
];

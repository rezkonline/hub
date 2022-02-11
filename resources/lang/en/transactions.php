<?php

return [
    'plural' => 'Transactions',
    'singular' => 'Transaction',
    'empty' => 'There are no transactions',
    'actions' => [
        'list' => 'List Transactions',
        'show' => 'Show Transaction',
        'create' => 'Create a new transaction',
        'edit' => 'Edit Transaction',
        'delete' => 'Delete Transaction',
        'save' => 'Save',
    ],
    'messages' => [
        'created' => 'The transaction has been created successfully.',
        'updated' => 'The transaction has been updated successfully.',
        'deleted' => 'The transaction has been deleted successfully.',
    ],
    'attributes' => [
        'amount' => 'Amount',
        'customer_id' => 'Customer',
        'note' => 'Note',
        'payment_type' => 'Payment Type',
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

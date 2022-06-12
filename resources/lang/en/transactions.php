<?php

return [
    'plural' => 'Transactions',
    'singular' => 'Transaction',
    'empty' => 'There are no transactions',
    'empty_note' => 'There is no note',
    'select' => 'Select Transaction',
    'perPage' => 'Transactions per page',
    'receipt_empty' => 'No Receipt',
    'actions' => [
        'list' => 'Transactions',
        'show' => 'Show',
        'create' => 'Create a Transaction',
        'edit' => 'Edit Transaction',
        'delete' => 'Delete Transaction',
        'save' => 'Save',
        'filter' => 'Filter',
    ],
    'messages' => [
        'created' => 'The transaction has been created successfully .',
        'updated' => 'The transaction has been updated successfully .',
        'deleted' => 'The transaction has been deleted successfully .',
    ],
    'attributes' => [
        'amount' => 'Amount',
        'customer_id' => 'Customer',
        'actor_id' => 'By',
        'payment_type' => 'Method',
        'receipt' => 'Receipt',
        'note' => 'Notes',
        'date' => 'Date',
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

<?php

return [
    'plural' => 'Campaigns',
    'singular' => 'CampaignResource',
    'empty' => 'There are no campaigns',
    'perPage' => 'Campaigns Per Page',
    'select' => 'Select a campaign',
    'actions' => [
        'list' => 'List Campaigns',
        'show' => 'Show Campaigns',
        'create' => 'Create a new campaign',
        'edit' => 'Edit campaign',
        'delete' => 'Delete campaign',
        'save' => 'Save',
        'filter' => 'Filter',
    ],
    'messages' => [
        'created' => 'The campaign has been created successfully.',
        'updated' => 'The campaign has been updated successfully.',
        'deleted' => 'The campaign has been deleted successfully.',
    ],
    'attributes' => [
        'name' => 'Name',
        'description' => 'Description',
        'customer_id' => 'Customer',
        'target' => 'Target',
        'status' => 'Status',
        'budget' => 'Budget',
        'attachments' => 'Attachments',
        'created_at' => 'Created At',
    ],
    'types' => [
        \App\Models\Campaign::COMPLETED_STATUS => 'Completed',
        \App\Models\Campaign::ONGOING_STATUS => 'Proccessing',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the campaign ?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
    ],
];

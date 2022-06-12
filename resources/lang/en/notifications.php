<?php

return [
    'singular' => 'Notification',
    'plural' => 'Notifications',
    'empty' => 'There are no notifications.',
    'tasks' => [
        'body' => ':user added a new task titled :title',
        'status' => [
            \App\Models\Task::ONGOING_STATUS => 'Task ":title" status changed to ONGOING',
            \App\Models\Task::COMPLETED_STATUS => 'Task ":title" status changed to COMPLETED',
        ],
    ],
    'campaigns' => [
        'body' => ':user added a new campaign titled :title',
        'status' => [
            \App\Models\Campaign::ONGOING_STATUS => 'Campaign ":title" status changed to ONGOING',
            \App\Models\Campaign::COMPLETED_STATUS => 'Campaign ":title" status changed to COMPLETED',
        ],
    ],
    'schedules' => [
        'body' => ':user added a new schedule titled :title',
        'status' => [
            \App\Models\Schedule::ONGOING_STATUS => 'Schedule ":title" status changed to ONGOING',
            \App\Models\Schedule::COMPLETED_STATUS => 'Schedule ":title" status changed to COMPLETED',
        ],
    ],
    'messages' => [
        'body' => ':user replied to your comment',
    ],
];

<?php

return [
    'singular' => 'الاشعار',
    'plural' => 'الاشعارات',
    'empty' => 'لا يوجد اشعارات حتى الان',
    'tasks' => [
        'body' => 'اضاف :user مهمة جديدة بعنوان :title',
        'status' => [
            \App\Models\Task::ONGOING_STATUS => 'تم تغيير حالة المهمة :title الي جارية',
            \App\Models\Task::COMPLETED_STATUS => 'تم تغيير حالة المهمة :title الي منتهية',
        ],
    ],
    'campaigns' => [
        'body' => 'اضاف :user حملة اعلانية جديدة بعنوان :title',
        'status' => [
            \App\Models\Campaign::ONGOING_STATUS => 'تم تغيير حالة الحملة الاعلانية :title الي جارية',
            \App\Models\Campaign::COMPLETED_STATUS => 'تم تغيير حالة الحملة الاعلانية :title الي منتهية',
        ],
    ],
    'schedules' => [
        'body' => 'اضاف :user محتوي مجدول جديد بعنوان :title',
        'status' => [
            \App\Models\Schedule::ONGOING_STATUS => 'تم تغيير حالة المحتوي المجدول :title الي جارية',
            \App\Models\Schedule::COMPLETED_STATUS => 'تم تغيير حالة المحتوي المجدول :title الي منتهية',
        ],
    ],
    'messages' => [
        'body' => 'اضاف :user رد جديد',
    ],
];

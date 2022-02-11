<?php

return [
    'plural' => 'المستخدمين',
    'perPage' => 'عدد النتائج في الصفحة',
    'since' => 'عضو منذ :date',
    'profile' => 'الملف الشخصي',
    'actions' => [
        'filter' => 'بحث',
    ],
    'alerts' => [
        'registered' => 'شكراً لك على تسجيلك نرجو منك التحدث مع مدير الحساب من خلال الشات الموجود في القائمة الجانبية ليقوم بإعداد حسابك بناء على متطلباتك'
    ],
    'types' => [
        \App\Models\User::SUPERVISOR_TYPE => 'مدير حسابات',
        \App\Models\User::ADMIN_TYPE => 'مدير',
        \App\Models\User::EMPLOYEE_TYPE => 'موظف',
        \App\Models\User::CUSTOMER_TYPE => 'عميل',
    ],
];

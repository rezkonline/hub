<?php

return [
    'plural' => 'المحتوي المجدول',
    'singular' => 'محتوي مجدول',
    'empty' => 'لا يوجد محتوي مجدول',
    'select' => 'اختر المحتوي المجدول',
    'perPage' => 'عدد المحتوي المجدول بالصفحة',
    'actions' => [
        'list' => 'عرض المحتويات المجدولة ',
        'show' => 'عرض',
        'create' => 'إضافة محتوي مجدول جديد',
        'edit' => 'تعديل  المحتوي المجدول',
        'delete' => 'حذف المحتوي المجدول',
        'save' => 'حفظ',
        'filter' => 'بحث',
    ],
    'messages' => [
        'created' => 'تم إضافة المحتوي المجدول بنجاح .',
        'updated' => 'تم تعديل المحتوي المجدول بنجاح .',
        'deleted' => 'تم حذف المحتوي المجدول بنجاح .',
    ],
    'attributes' => [
        'name' => 'اسم المحتوي',
        'description' => 'الوصف',
        'customer_id' => 'المستخدم',
        'status' => 'الحالة',
        'attachments' => 'المرفقات',
        'created_at' => 'تاريخ الاضافة',
    ],
    'types' => [
        \App\Models\Task::COMPLETED_STATUS => 'منتهيه',
        \App\Models\Task::ONGOING_STATUS => 'جارية',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد حذف هذا المحتوي المجدول ?',
            'confirm' => 'حذف',
            'cancel' => 'إلغاء',
        ],
    ],
];

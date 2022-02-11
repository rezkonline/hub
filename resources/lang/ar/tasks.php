<?php

return [
    'plural' => 'المهمات',
    'singular' => 'مهمة',
    'empty' => 'لا توجد مهمات',
    'select' => 'اختر المهمة',
    'perPage' => 'عدد المهمات بالصفحة',
    'actions' => [
        'list' => 'عرض المهمات ',
        'show' => 'عرض',
        'create' => 'إضافة مهمة جديدة',
        'edit' => 'تعديل  المهمات',
        'delete' => 'حذف المهمة',
        'save' => 'حفظ',
        'filter' => 'بحث',
    ],
    'messages' => [
        'created' => 'تم إضافة المهمات بنجاح .',
        'updated' => 'تم تعديل المهمات بنجاح .',
        'deleted' => 'تم حذف المهمات بنجاح .',
    ],
    'attributes' => [
        'name' => 'اسم المهمة',
        'description' => 'الوصف',
        'customer_id' => 'العميل',
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
            'info' => 'هل أنت متأكد انك تريد حذف هذه المهمة ?',
            'confirm' => 'حذف',
            'cancel' => 'إلغاء',
        ],
    ],
];

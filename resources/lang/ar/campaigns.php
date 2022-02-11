<?php

return [
    'plural' => 'الحملات الاعلانية',
    'singular' => 'حملة اعلانية',
    'empty' => 'لا توجد حملات اعلانية',
    'select' => 'اختر حملة اعلانية',
    'perPage' => 'عدد الحملات الاعلانية بالصفحة',
    'actions' => [
        'list' => 'عرض الحملات الاعلانية ',
        'show' => 'عرض',
        'create' => 'إضافة حملة اعلانية جديدة',
        'edit' => 'تعديل  الحملة الاعلانية',
        'delete' => 'حذف الحملة الاعلانية',
        'save' => 'حفظ',
        'filter' => 'بحث',
    ],
    'messages' => [
        'created' => 'تم إضافة الحملة الاعلانية بنجاح .',
        'updated' => 'تم تعديل الحملة الاعلانية بنجاح .',
        'deleted' => 'تم حذف الحملة الاعلانية بنجاح .',
    ],
    'attributes' => [
        'name' => 'اسم الحملة الاعلانية',
        'description' => 'الوصف',
        'customer_id' => 'المستخدم',
        'target' => 'الهدف',
        'status' => 'الحالة',
        'budget' => 'التكلفة',
        'attachments' => 'المرفقات',
        'created_at' => 'تاريخ الاضافة',
    ],
    'types' => [
        \App\Models\Campaign::COMPLETED_STATUS => 'منتهيه',
        \App\Models\Campaign::ONGOING_STATUS => 'جارية',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد حذف هذه الحملة الاعلانية ?',
            'confirm' => 'حذف',
            'cancel' => 'إلغاء',
        ],
    ],
];

<?php

Breadcrumbs::for('dashboard.tasks.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('tasks.plural'), route('dashboard.tasks.index'));
});

<?php

Breadcrumbs::for('dashboard.schedules.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('schedules.plural'), route('dashboard.schedules.index'));
});

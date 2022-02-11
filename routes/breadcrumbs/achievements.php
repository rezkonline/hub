<?php

Breadcrumbs::for('dashboard.achievements.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('achievements.plural'), route('dashboard.achievements.index'));
});

Breadcrumbs::for('dashboard.achievements.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.achievements.index');
    $breadcrumb->push(trans('achievements.actions.create'), route('dashboard.achievements.create'));
});

Breadcrumbs::for('dashboard.achievements.edit', function ($breadcrumb, $achievement) {
    $breadcrumb->parent('dashboard.achievements.index', $achievement);
    $breadcrumb->push(trans('achievements.actions.edit'), route('dashboard.achievements.edit', $achievement));
});

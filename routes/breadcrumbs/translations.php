<?php

Breadcrumbs::for('dashboard.translations.index', function ($breadcrumb, $parent) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('translations.plural'));
    $breadcrumb->push($parent->name);
});

Breadcrumbs::for('dashboard.translations.create', function ($breadcrumb, $parent) {
    $breadcrumb->parent('dashboard.translations.index', $parent);
    $breadcrumb->push(trans('translations.actions.create'));
});

Breadcrumbs::for('dashboard.translations.edit', function ($breadcrumb, $parent) {
    $breadcrumb->parent('dashboard.translations.index', $parent);
});

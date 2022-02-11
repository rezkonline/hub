<?php

Breadcrumbs::for('dashboard.users.index', function ($breadcrumb, $resource) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans($resource.'.plural'), route('dashboard.users.index', ['type' => Str::singular($resource)]));
});

Breadcrumbs::for('dashboard.users.create', function ($breadcrumb, $resource) {
    $breadcrumb->parent('dashboard.users.index', $resource);
    $breadcrumb->push(trans($resource.'.actions.create'), route('dashboard.users.create'));
});

Breadcrumbs::for('dashboard.users.show', function ($breadcrumb, $user, $resource) {
    $breadcrumb->parent('dashboard.users.index', $resource);
    $breadcrumb->push($user->name, route('dashboard.users.show', $user));
});

Breadcrumbs::for('dashboard.users.edit', function ($breadcrumb, $user, $resource) {
    $breadcrumb->parent('dashboard.users.show', $user, $resource);
    $breadcrumb->push(trans($resource.'.actions.edit'), route('dashboard.users.edit', $user));
});

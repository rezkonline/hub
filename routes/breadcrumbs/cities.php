<?php

Breadcrumbs::for('dashboard.cities.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('cities.plural'), route('dashboard.cities.index'));
});

Breadcrumbs::for('dashboard.cities.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.cities.index');
    $breadcrumb->push(trans('cities.actions.create'), route('dashboard.cities.create'));
});

Breadcrumbs::for('dashboard.cities.show', function ($breadcrumb, $country) {
    $breadcrumb->parent('dashboard.cities.index');
    $breadcrumb->push($country->name, route('dashboard.cities.show', $country));
});

Breadcrumbs::for('dashboard.cities.edit', function ($breadcrumb, $country) {
    $breadcrumb->parent('dashboard.cities.show', $country);
    $breadcrumb->push(trans('cities.actions.edit'), route('dashboard.cities.edit', $country));
});

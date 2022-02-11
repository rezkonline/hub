<?php

Breadcrumbs::for('dashboard.reports.financial', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('reports.plural'), route('dashboard.reports.financial'));
});

Breadcrumbs::for('dashboard.reports.arrears', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('reports.plural'), route('dashboard.reports.arrears'));
});

Breadcrumbs::for('dashboard.reports.customers', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('reports.plural'), route('dashboard.reports.customers'));
});

Breadcrumbs::for('dashboard.reports.transactions', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('reports.plural'), route('dashboard.reports.transactions'));
});

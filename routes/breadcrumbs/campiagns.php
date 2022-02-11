<?php

Breadcrumbs::for('dashboard.campaigns.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('campaigns.plural'), route('dashboard.campaigns.index'));
});

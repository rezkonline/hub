<?php

Breadcrumbs::for('dashboard.meetings.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('meetings.plural'), route('dashboard.meetings.index'));
});

Breadcrumbs::for('dashboard.meetings.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.meetings.index');
    $breadcrumb->push(trans('meetings.actions.create'), route('dashboard.meetings.create'));
});

Breadcrumbs::for('dashboard.meetings.show', function ($breadcrumb, $meeting) {
    $breadcrumb->parent('dashboard.meetings.index');
    $breadcrumb->push($meeting->name, route('dashboard.meetings.show', $meeting));
});

Breadcrumbs::for('dashboard.meetings.edit', function ($breadcrumb, $meeting) {
    $breadcrumb->parent('dashboard.meetings.show', $meeting);
    $breadcrumb->push(trans('meetings.actions.edit'), route('dashboard.meetings.edit', $meeting));
});

<?php

namespace App\Models;

use Parental\HasChildren;
use App\Http\Filters\Filterable;
use Spatie\MediaLibrary\HasMedia;
use App\Models\Scopes\UserScopes;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Helpers\UserHelpers;
use App\Models\Concerns\Selectable;
use App\Models\Concerns\HasMediaTrait;
use App\Models\Relations\UserRelations;
use App\Models\Presenters\UserPresenter;
use Illuminate\Notifications\Notifiable;
use Laracasts\Presenter\PresentableTrait;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\Activitylog\Traits\CausesActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Internetcode\LaravelUserSettings\Traits\HasSettingsTrait;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use Notifiable,
        UserHelpers,
        Selectable,
        HasChildren,
        HasUploader,
        HasMediaTrait,
        HasApiTokens,
        HasChildren,
        PresentableTrait,
        Filterable,
        Impersonate,
        CausesActivity,
        HasSettingsTrait;

    /**
     * The code of the admin type.
     *
     * @var string
     */
    const ADMIN_TYPE = 'admin';

    /**
     * The code of the supervisor type.
     *
     * @var string
     */
    const SUPERVISOR_TYPE = 'supervisor';

    /**
     * The code of the employee type.
     *
     * @var string
     */
    const EMPLOYEE_TYPE = 'employee';

    /**
     * The code of the employee type.
     *
     * @var string
     */
    const CUSTOMER_TYPE = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'country_id',
        'city_id',
        'manager_id',
    ];

    /**
     * @var array
     */
    protected $childTypes = [
        self::ADMIN_TYPE => Admin::class,
        self::SUPERVISOR_TYPE => Supervisor::class,
        self::EMPLOYEE_TYPE => Employee::class,
        self::CUSTOMER_TYPE => Customer::class,
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['media'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The presenter class name.
     *
     * @var string
     */
    protected $presenter = UserPresenter::class;

    /**
     * Get the number of models to return per page.
     *
     * @return int
     */
    public function getPerPage()
    {
        return request('perPage', parent::getPerPage());
    }

    /**
     * Register the user media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->useFallbackUrl('https://www.gravatar.com/avatar/'.md5($this->email).'?d=mm')
            ->singleFile();

        $this->addMediaCollection('attachments');
    }

    /**
     * @return bool
     */
    public function canImpersonate()
    {
        return $this->isAdmin() || $this->isSupervisor() || $this->isEmployee();
    }

    /**
     * @return bool
     */
    public function canBeImpersonated()
    {
        return $this->isCustomer();
    }

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'App.Models.User.'.$this->id;
    }

    /**
     * Get the entity's notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');
    }

    /**
     * Get the entity's read notifications.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function readNotifications()
    {
        return $this->notifications()->whereNotNull('read_at');
    }

    /**
     * Get the entity's unread notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function unreadNotifications()
    {
        return $this->notifications()->whereNull('read_at');
    }

    /**
     * getSettingFields function.
     * Get the default possible settings for the user. Can be overwritten
     * in the user model.
     *
     * @return array
     */
    public function getSettingFields()
    {
        return array_keys(trans('customers.settings'));
    }

    /**
     * Get the dashboard profile link.
     *
     * @return string
     */
    public function dashboardProfile(): string
    {
        return '#';
    }
}

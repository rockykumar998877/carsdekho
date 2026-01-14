<?php

namespace Domain\Admin\User\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use NodeSpace\CommonHelpers\Helpers\DateHelper;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    protected $fillable = ['name', 'guard_name'];

    /**
     * function to get attribute name 
     */
    public function attributeNames()
    {
        return [
            'name' => 'Name',
            'guard_name' => 'Guard Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At'
        ];
    }

    /**
     * function to get the description data
     *
     * @param string $eventName
     * @return string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        return ucfirst($eventName) . " Role";
    }

    /**
     * Scope a query to filter records by the customer role name.
     *
     * This scope retrieves only those records where the `name` column
     * matches the configured customer role name.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query  The query builder instance.
     * @return \Illuminate\Database\Eloquent\Builder  The modified query builder instance.
     */
    #[Scope]
    protected function scopeCustomerId(Builder $query)
    {
        return $query->where('name', config('constants.customer_role_name'));
    }

    /**
     * function to format the updated at value
     *
     * @param mixed $value
     * @return mixed
     */
    public function getCreatedAtAttribute($value)
    {
        return DateHelper::formatDateTime($value, 'd-m-Y H:i:s');
    }

    /**
     * function to formatted the updated-at value
     *
     * @param mixed $value
     * @return mixed
     */
    public function getUpdatedAtAttribute($value)
    {
        return DateHelper::formatDateTime($value, 'd-m-Y H:i:s');
    }
}

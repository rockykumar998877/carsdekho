<?php

namespace Domain\Admin\User\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Kalnoy\Nestedset\NodeTrait;
use NodeSpace\CommonHelpers\Helpers\DateHelper;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Contracts\Permission as ContractsPermission;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission implements ContractsPermission
{
    use NodeTrait;

    protected $fillable = [
        'name',
        'guard_name',
        'parent_id',
        '_lft',
        '_rgt'
    ];

    /**
     * function to get the attribute name value
     *
     * @return array
     */
    public function attributeNames(): array
    {
        return [
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At'
        ];
    }

    /**
     * function to get the description attribute value
     *
     * @param string $eventName
     * @return string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        return ucfirst($eventName) . " Permission";
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
        return DateHelper::formatDateTime($value,  'd-m-Y H:i:s');
    }

    // Scope for root parent permissions
    #[Scope]
    protected function scopeRootParents(Builder $query)
    {
        return $query->whereNull('parent_id')->pluck('name', 'id');
    }
}

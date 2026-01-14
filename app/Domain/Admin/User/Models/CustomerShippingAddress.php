<?php

namespace Domain\Admin\User\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Domain\Core\Traits\CommonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domain\Admin\User\Enums\UserEnumsStatus;

class CustomerShippingAddress extends Model
{
    use  CommonTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'street',
        'city',
        'state',
        'pinCode',
        'country',
        'type',
        'mobile_no',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => UserEnumsStatus::class,
        ];
    }
    
    /**
     * Scope a query to include only records belonging to a specific user.
     *
     * This query scope filters results by the given user ID and selects
     * only the `id` and `name` columns.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query  The query builder instance.
     * @param  int  $userId  The ID of the user whose data should be retrieved.
     * @return \Illuminate\Database\Eloquent\Builder  The modified query builder instance.
     */
    #[Scope]
    public function scopeUserData($query, $userId)
    {
        return $query->where('user_id', $userId)->select('id', 'name');
    }
}

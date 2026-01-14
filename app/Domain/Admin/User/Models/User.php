<?php

namespace Domain\Admin\User\Models;

use Database\Factories\UserFactory;
use Domain\Core\Traits\CommonTrait;
use App\Domain\Front\Cart\Models\Cart;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domain\Front\Wishlist\Models\Wishlist;
use App\Domain\Admin\User\Enums\UserEnumsStatus;
use App\Domain\Front\Wishlist\Models\WishlistItem;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, CommonTrait, HasRoles, SoftDeletes;

    protected $appends = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'mobile_no',
        'status',
        'gender',
        'image',
        'date_of_birth',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * function to define the factory method path
     *
     * @return void
     */
    protected static function newFactory()
    {
        return UserFactory::new();
    }

    /**
     * Accessor for the "name" attribute.
     *
     * Combines the user's first name and last name into a single
     * full name string. If either of them is null/empty, it will
     * gracefully handle it and trim any extra spaces.
     *
     * @return string The full name of the user
     */
    public function getNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    /**
     * Scope a query to retrieve all active users with the customer role.
     *
     * This scope filters users who have a role name matching the configured
     * customer role name and whose status is set to active.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query  The query builder instance.
     * @return \Illuminate\Support\Collection  A collection of active customers.
     */
    public function scopeGetAllCustomer(Builder $query)
    {
        return $query->whereHas('roles', function (Builder $query) {
            $query->where('name', config('constants.customer_role_name'));
        })
            ->where('status', UserEnumsStatus::active)
            ->get();
    }
}

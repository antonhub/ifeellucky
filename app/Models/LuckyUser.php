<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LuckyUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'link_hash',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'link_hash',
        'is_link_active',
        'link_expires_at',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->name = strtolower($model->name);
            // @todo move it to the separate service
            $linkExpiresAt = now()->addDays(config('lucky_user.link_expiration_days'));
            // @todo move it to the separate hash service
            $linkHash = md5($model->name . $linkExpiresAt);
            $model->link_hash = $linkHash;
            $model->link_expires_at = $linkExpiresAt;
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LuckyHistory extends Model
{

    protected $table = 'lucky_history';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_win' => false,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'link_hash',
        'is_win',
        'won_amount',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $dateFormat = 'U';
    protected $table = 'user';
    protected $dates = [
        'updated_at',
        'created_at',
    ];
    protected $fillable = ['notification_token'];

    public $timestamps = true;
}

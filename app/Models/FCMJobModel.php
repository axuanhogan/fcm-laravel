<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FCMJobModel extends Model
{
    protected $primaryKey = 'fj_id';
    protected $dateFormat = 'U';
    protected $table = 'fcm_job';
    protected $dates = [
        'updated_at',
        'created_at',
    ];
    protected $fillable = ['identifier', 'message', 'fcm_result', 'deliver_at'];

    public $timestamps = true;
}

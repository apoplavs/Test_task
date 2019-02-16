<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\Http\Controllers\SubscriberController;
use Carbon\Carbon;

class Subscriber extends Model
{
    const TIMEZONE = 'Europe/Kiev';
    const EXPIRED_MONTHS = 3;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public $timestamps = false;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 
        'revoked', 'added_on', 'expires_at'
    ];


    /**
     * перевіряє чи існує і валідний заданий id в БД
     *
     * @param string $id
     * @return boolean
     */
    public static function validateToken(string $id) : bool
    {
        $exists = static::select('id')
            ->where('id', '=', $id)
            ->where('revoked', '=', 0)
            ->where('expires_at', '>=', Carbon::now(self::TIMEZONE))
            ->first();

        return !empty($exists);
    }

}

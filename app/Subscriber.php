<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\Http\Controllers\SubscriberController;
use Carbon\Carbon;

class Subscriber extends Model
{
    const TIMEZONE = 'Europe/Kiev';
    const EXPIRED_MONTHS = 3;

    public $timestamps = false;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'url_token', 
        'revoked', 'added_on', 'expires_at'
    ];


    /**
     * перевіряє чи існує і валідний заданий токен в БД
     *
     * @param string $token
     * @return boolean
     */
    public static function validateToken(string $token) : bool
    {
        $exists = static::select('id')
            ->where('url_token', '=', $token)
            ->where('revoked', '=', 0)
            ->where('expires_at', '>=', Carbon::now(self::TIMEZONE))
            ->first();

        return !empty($exists);
    }

}

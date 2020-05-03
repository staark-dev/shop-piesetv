<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;
use Config;

class Online extends Model
{
    protected $hidden = ['payload'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $table = 'sessions';

    public $timestamps = false;

    /**
     * Returns all the guest users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGuests($query)
    {
        return $query->whereNull('user_id')->where('last_activity', '>=', strtotime(Carbon::now()->subMinutes(Config::get('custom.activity_limit'))));
    }

    /**
     * Returns all the registered users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRegistered($query)
    {
        return $query->whereNotNull('user_id')->where('last_activity', '>=', strtotime(Carbon::now()->subMinutes(Config::get('custom.activity_limit'))))->with('user');
    }

    /**
     * Updates the session of the current user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpdateCurrent($query)
    {
        return $query->where('id', Session::getId())->update(array(
            'user_id' => !empty(Auth::user()) ? Auth::user()->id : null
        ));
        
    }


     /**
     * Returns the user that belongs to this entry.
     *
     * @return \Cartalyst\Sentry\Users\EloquentUser
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

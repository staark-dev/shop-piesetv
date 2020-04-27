<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Product;
use Auth;
use Carbon\Carbon;

class UserHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'log', 'type', 'user_id', 'product_id'
    ];

    public $timestamps = false;

    public function login($uname, $uid)
    {
        $now = Carbon::now();
        $ip = \request()->ip();
        $log = new UserHistory();
        $log->log = $uname ." has been login. [". $now ."] [IP: ". $ip ."]";
        $log->type = 1;
        $log->user_id = $uid;
        $log->save();
    }

    public function viewProduct($product)
    {
        if(Auth::guest())
        {
            // Get time and ip
            $now = Carbon::now();
            $ip = \request()->ip();

            // Create log
            $log = new UserHistory();
            $log->log = "Vizitator a vizitat produsul " . $product->title . ". [". $now ."] [IP: ". $ip ."]";
            $log->type = 2;
            $log->product_id = $product->id;
            // $log->user_id = 0;
            $log->save();
        } else {

            $logCount = UserHistory::where('user_id', '=', Auth::user()->id)->where('product_id', '=', $product->id)->get()->count();

            // Get time and ip
            $now = Carbon::now();
            $ip = \request()->ip();

            if($logCount == 0) {
                // Create log
                $log = new UserHistory;
                $log->log = Auth::user()->name . " a vizitat produsul " . $product->title . ". [". $now ."] [IP: ". $ip ."]";
                $log->type = 2;
                $log->user_id = Auth::user()->id;
                $log->product_id = $product->id;
                $log->save();
            }
        }
    }
}

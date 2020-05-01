<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Address extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'company', 'address1', 'address2', 'city', 'user_id',
        'phone', 'email', 'postal_code', 'user_ip', 'total_prices', 'tax', 'products', 'note'
    ];

    protected $table = 'addresses';

    /*protected $casts = [
        '' => 'datetime',
    ];*/

    public $timestamps = false;

    public function storeAddress(array $data)
    {
        if($this->checkAddress($data['user_id']) == true)
        {
            $stmp = new Address;
            $stmp->first_name   = $data['first_name'];
            $stmp->last_name    = $data['last_name'];
            $stmp->company      = $data['company'];
            $stmp->address1     = $data['address1'];
            $stmp->address2     = $data['address2'];
            $stmp->city         = $data['city'];
            $stmp->phone        = $data['phone'];
            $stmp->email        = $data['email'];
            $stmp->postal_code  = $data['postal_code'];
            $stmp->user_ip      = $data['user_ip'];
            $stmp->user_id      = $data['user_id'];
            $stmp->save();
        }
    }

    public saveOrderAddress(array $data)
    {
        if($this->checkAddress($data['user_id']) == true)
        {
            $stmp = new Address;
            $stmp->first_name   = $data['first_name'];
            $stmp->last_name    = $data['last_name'];
            $stmp->company      = $data['company'];
            $stmp->address1     = $data['address1'];
            $stmp->address2     = $data['address2'];
            $stmp->city         = $data['city'];
            $stmp->phone        = $data['phone'];
            $stmp->email        = $data['email'];
            $stmp->postal_code  = $data['postal_code'];
            $stmp->user_ip      = $data['user_ip'];
            $stmp->user_id      = $data['user_id'];
            $stmp->total_prices = $data['total_prices'];
            $stmp->tax          = $data['tax'];
            $stmp->products     = json_encode($data['products']);
            $stmp->note         = $data['note'];
            $stmp->save();
        }

        return false;
    }

    private function checkAddress($user_id = null)
    {
        $res = Address::whereNotNull('user_id')->get()->count();
        if($res == 0) {
            return true;
        }

        return false;
    }
}

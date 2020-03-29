<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cache;
use Auth;
use Carbon\Carbon;
use App\Product;
use App\Cart;
use Illuminate\Support\Arr;

class AddCartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'store']);
    }

    public function index()
    {
        if(Auth::check()) {
            $cart = Cart::where('user_id', '=', Auth::user()->id)->get();
            Cache::forget('cart_items');
            if($cart->count() > 0)  Cache::add('cart_items', count(json_decode($cart[0]->product_info, true) ));
        } else {
            $ip = getRealIpAddr();
            $cart = Cart::where('user', '=', $ip)->get();
            Cache::forget('cart_items');
            if($cart->count() > 0) Cache::add('cart_items', count(json_decode($cart[0]->product_info, true)));
        }

        if(Auth::check()) {
            $cart = Cart::where('user_id', '=', Auth::user()->id)->get();
            return view('cart', compact('cart'));
        } else {
            $ip = request()->ip();
            $cart = Cart::where('user', '=', $this->getRealIpAddr())->get();
            return view('cart', compact('cart'));
        }
    }

    public function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
          $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function store(Request $request, $product)
    {
        $item = Product::with(['categories', 'subCategories'])->find($product);
        $ip = $request->ip();

        if(Auth::check())
        {
            // Check in db exists or not this product.
            $exists = Cart::where('user_id', '=', Auth::user()->id)->get();

            if($exists->count() == 0) {
                // Add in cart by logged user
                $produs = ['produs_'.$item->id =>
                    [
                        'image' => $item->image,
                        'name' => $item->title,
                        'quantity' => 1,
                        'price' => $item->price
                    ]
                ];

                $cart = new Cart;
                $cart->user_id      = Auth::user()->id;
                $cart->user         = $ip;
                $cart->product_info = json_encode([$produs]);
                $cart->save();

                return redirect()->route('cart.index');
            } else {
                $cart = Cart::find($exists[0]->id)->toArray();
                $produsGet = json_decode($cart['product_info'], true);
                $produsText = 'produs_' . $item->id;
                $findItem = null;
                $findId = -1;
                

                // Find product is or not in cart
                foreach($produsGet as $key => $data) {
                    if(Arr::has($data, $produsText))
                    {
                        $findItem = true;
                        $findId = $key;
                    }
                }

                if($findItem == true) {
                    return redirect()->route('cart.index');
                } else {

                    $produsGet[] = ['produs_'.$item->id =>
                        [
                            'image' => $item->image,
                            'name' => $item->title,
                            'quantity' => 1,
                            'price' => $item->price
                        ]
                    ];

                    Cart::whereId($cart['id'])->update([
                        'product_info' => json_encode($produsGet, 0)
                    ]);

                    return redirect()->route('cart.index');
                }
                
                /*if(isset($produsGet[''.$produsText.'']))
                {
                    dd($produsGet[''.$produsText.'']);
                    if(count($produsGet[''.$produsText.'']) > 0) {
                        Cart::whereId($cart->id)->update([
                            'product_info->' . $produsText . '->quantity' => $produsGet[''.$produsText.'']['quantity'] + 1,
                            'product_info->' . $produsText . '->price' => $produsGet[''.$produsText.'']['price'] + $item->price
                        ]);
                    } else {
                        dd("  ");
                        $produs = ['produs_'.$item->id =>
                            [
                                'image' => $item->image,
                                'name' => $item->title,
                                'quantity' => 1,
                                'price' => $item->price
                            ]
                        ];

                        Cart::whereId($cart->id)->update([
                            'product_info' => $cart->product_info[count($cart->product_info)] . ', ' . json_encode($produs)
                        ]);
                    }
                }*/

                //return redirect()->route('cart.index');
            }
        } else {
            // Check in db exists or not this product.
            $exists = Cart::where('user', '=', $this->getRealIpAddr())->get();

            if($exists->count() == 0) {
                // Add in cart by logged user
                $produs = ['produs_'.$item->id =>
                    [
                        'image' => $item->image,
                        'name' => $item->title,
                        'quantity' => 1,
                        'price' => $item->price
                    ]
                ];

                $cart = new Cart;
                $cart->user_id      = null;
                $cart->user         = $this->getRealIpAddr();
                $cart->product_info = json_encode([$produs]);
                $cart->save();

                return redirect()->route('cart.index');
            } else {
                $cart = Cart::find($exists[0]->id)->toArray();
                $produsGet = json_decode($cart['product_info'], true);
                $produsText = 'produs_' . $item->id;
                $findItem = null;
                $findId = -1;
                

                // Find product is or not in cart
                foreach($produsGet as $key => $data) {
                    if(Arr::has($data, $produsText))
                    {
                        $findItem = true;
                        $findId = $key;
                    }
                }

                if($findItem == true) {
                    return redirect()->route('cart.index');
                } else {

                    $produsGet[] = ['produs_'.$item->id =>
                        [
                            'image' => $item->image,
                            'name' => $item->title,
                            'quantity' => 1,
                            'price' => $item->price
                        ]
                    ];

                    Cart::whereId($cart['id'])->update([
                        'product_info' => json_encode($produsGet, 0)
                    ]);

                    return redirect()->route('cart.index');
                }
            }
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
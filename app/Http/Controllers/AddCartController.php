<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cache;
use Auth;
use Carbon\Carbon;
use App\Product;
use App\Cart;
use App\User;
use Illuminate\Support\Arr;
use App\Events\UserAddtoCart;

function getRealIpAddr()
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

class AddCartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'store', 'destroy', 'placeOrder', 'update']);
    }

    public function index()
    {
        // Get all item for user in cart
        if(Auth::check()) {
            $cart = Cart::where('user_id', '=', Auth::user()->id)->get();

            if($cart->count() > 0) {
                $cart = $cart[0];
                return view('cart', compact('cart'));
            } else {
                $cart = $this->emptyCart();
                return view('cart', compact('cart'));
            }

        } else {
            $ip = request()->ip();
            $cart = Cart::where('user', '=', $this->getRealIpAddr())->get();

            if($cart->count() > 0) {
                $cart = $cart[0];
                return view('cart', compact('cart'));
            } else {
                $cart = $this->emptyCart();
                return view('cart', compact('cart'));
            }
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

    private function emptyCart()
    {
        $no_db = new \stdClass();
        $no_db->id = null;
        $no_db->user_id = null;
        $no_db->user = null;
        $no_db->product_info = json_encode([(object)[]]);
        $no_db->created_at = null;
        $no_db->updated_at = null;
        
        return $no_db;
    }

    /**
     * Salvare produse in cos
     * @param ('product')
     * @return array
    */
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
                        'url' => $item->slug,
                        'quantity' => 1,
                        'price' => $item->price
                    ]
                ];

                $cart = new Cart;
                $cart->user_id      = Auth::user()->id;
                $cart->user         = $ip;
                $cart->product_info = json_encode([$produs]);
                $cart->save();

                event(new UserAddtoCart($item));

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
                            'url' => $item->slug,
                            'quantity' => 1,
                            'price' => $item->price
                        ]
                    ];

                    Cart::whereId($cart['id'])->update([
                        'product_info' => json_encode($produsGet, 0)
                    ]);

                    event(new UserAddtoCart($item));
                    return redirect()->route('cart.index');
                }
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
                        'url' => $item->slug,
                        'quantity' => 1,
                        'price' => $item->price
                    ]
                ];

                $cart = new Cart;
                $cart->user_id      = null;
                $cart->user         = $this->getRealIpAddr();
                $cart->product_info = json_encode([$produs]);
                $cart->save();

                event(new UserAddtoCart($item));
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
                            'url' => $item->slug,
                            'quantity' => 1,
                            'price' => $item->price
                        ]
                    ];

                    Cart::whereId($cart['id'])->update([
                        'product_info' => json_encode($produsGet, 0)
                    ]);

                    event(new UserAddtoCart($item));
                    return redirect()->route('cart.index');
                }
            }
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Stergere produse din cos
     * Curatare cos daca sunt produse
     * @param 
     * @return 
    */
    public function destroy($id)
    {
        if(Auth::check())
        {
            $cart = Cart::where('user_id', '=', Auth::user()->id)->first();
            $data = json_decode($cart->product_info, true);
            // Store new data
            $result = [];

            foreach($data as $key => $value) {
                if(Arr::has($value, $id)) {
                    print("Remove item " . $id . " with key " . $key);
                    unset($data[$key]);
                }

                $result += $data;
            }

            Cart::whereId($cart->id)->update([
                'product_info' => json_encode($data, 0)
            ]);

            return redirect()->route('cart.index');
        } else {
            $cart = Cart::where('user', '=', getRealIpAddr())->first();
            $data = json_decode($cart->product_info, true);

            // Store new data
            $result = [];

            foreach($data as $key => $value) {
                if(Arr::has($value, $id)) {
                    print("Remove item " . $id . " with key " . $key);
                    unset($data[$key]);
                }

                $result += $data;
            }

            Cart::whereId($cart->id)->update([
                'product_info' => json_encode($data, 0)
            ]);

            return redirect()->route('cart.index');
        }
    }

    /**
     * Place order
     */
    public function placeOrder()
    {
        // Get all item for user in cart
        if(Auth::check()) {
            $cart = Cart::where('user_id', '=', Auth::user()->id)->get();

            if($cart->count() > 0) {
                $cart = $cart[0];
                return view('checkout', compact('cart'));
            } else {
                return redirect()->route('home');
            }

        } else {
            $ip = request()->ip();
            $cart = Cart::where('user', '=', $this->getRealIpAddr())->get();

            if($cart->count() > 0) {
                $cart = $cart[0];
                return view('checkout', compact('cart'));
            } else {
                return redirect()->route('home');
            }
        }
    }

    public function orderComplete(Request $request)
    {
        $validator = $request->validate([
            'Nume' => 'required|string|min:5',
            'Prenume' => 'required|string|min:5',
            'Telefon' => 'required|numeric|min:10',
            'Adresa' => 'required|string|min:5',
            'Oras' => 'required|string|min:4',
            'Cod Postal' => 'required|numeric|min:6',
            'Curier' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
}

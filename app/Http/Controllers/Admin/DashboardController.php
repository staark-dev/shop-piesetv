<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Config, App\Online;
use Carbon\Carbon;
use App\User, App\Product, App\Categories, App\SubCategories, App\Order;

class DashboardController extends Controller
{
    public static function get_browser($user_agent) {
        $t = strtolower($user_agent);
        $t = " " . $t;
        $platform = 'Unknown';
        $bot = 'Vizitator';
        $browser = 'Unknown';
        $mobile = 'Unknown';

        // Humans / Regular Users     
        if     (strpos($t, 'opera'     ) || strpos($t, 'opr/')     ) $browser = 'Opera'            ;
        elseif (strpos($t, 'edge'      )                           ) $browser = 'Edge'             ;
        elseif (strpos($t, 'chrome'    )                           ) $browser = 'Chrome'           ;
        elseif (strpos($t, 'safari'    )                           ) $browser = 'Safari'           ;
        elseif (strpos($t, 'firefox'   )                           ) $browser = 'Firefox'          ;
        elseif (strpos($t, 'msie'      ) || strpos($t, 'trident/7')) $browser = 'Internet Explorer';

        // Search Engines 
        elseif (strpos($t, 'google'    )                           ) $bot = '[Bot] Google'   ;
        elseif (strpos($t, 'bing'      )                           ) $bot = '[Bot] Bing'     ;
        elseif (strpos($t, 'slurp'     )                           ) $bot = '[Bot] Yahoo! Slurp';
        elseif (strpos($t, 'duckduckgo')                           ) $bot = '[Bot] DuckDuck' ;
        elseif (strpos($t, 'baidu'     )                           ) $bot = '[Bot] Baidu'       ;
        elseif (strpos($t, 'yandex'    )                           ) $bot = '[Bot] Yandex'      ;
        elseif (strpos($t, 'sogou'     )                           ) $bot = '[Bot] Sogou'       ;
        elseif (strpos($t, 'exabot'    )                           ) $bot = '[Bot] Exabot'      ;
        elseif (strpos($t, 'msn'       )                           ) $bot = '[Bot] MSN'         ;

        // Common Tools and Bots
        elseif (strpos($t, 'mj12bot'   )                           ) $bot = '[Bot] Majestic'     ;
        elseif (strpos($t, 'ahrefs'    )                           ) $bot = '[Bot] Ahrefs'       ;
        elseif (strpos($t, 'semrush'   )                           ) $bot = '[Bot] SEMRush'      ;
        elseif (strpos($t, 'rogerbot'  ) || strpos($t, 'dotbot')   ) $bot = '[Bot] Moz or OpenSiteExplorer';
        elseif (strpos($t, 'frog'      ) || strpos($t, 'screaming')) $bot = '[Bot] Screaming Frog';
       
        // Miscellaneous
        elseif (strpos($t, 'facebook'  )                           ) $bot = '[Bot] Facebook'     ;
        elseif (strpos($t, 'pinterest' )                           ) $bot = '[Bot] Pinterest'    ;
       
        // Check for strings commonly used in bot user agents  
        elseif (strpos($t, 'crawler' ) || strpos($t, 'api'    ) ||
                strpos($t, 'spider'  ) || strpos($t, 'http'   ) ||
                strpos($t, 'bot'     ) || strpos($t, 'archive') ||
                strpos($t, 'info'    ) || strpos($t, 'data'   )    ) $bot = '[Bot] Other'   ;
       

        //First get the platform?
        if (preg_match('/linux/i', $t)) {
            $platform = 'Linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $t)) {
            $platform = 'Mac OS';
        }
        elseif (preg_match('/windows|win32/i', $t)) {
            $platform = 'Windows';
        }
        elseif (preg_match('/unix/i', $t)) {
            $platform = 'Unix';
        }

        // First get mobile detect
        if(preg_match('/(android|bb\d+|meego).+mobile/i', $t))
        {
            $mobile = 'Telefon (Android)';
        }
        elseif(preg_match('/ip(hone|od)/i', $t))
        {
            $mobile = 'Telefon (iPhone/iPod)';
        }
        elseif(preg_match('/mobile/i', $t))
        {
            $mobile = 'Telefon (Unknown)';
        }
        elseif(preg_match('/blackberry/i', $t))
        {
            $mobile = 'Telefon (Blackberry)';
        }

        return [
            'browser' => $browser,
            'bot' => $bot,
            'platform' => $platform,
            'mobile' => $mobile
        ];
    }

    public function index(Request $request)
    {
        $users = User::all();
        $products = Product::all();
        $cat = Categories::all();
        $subCat = SubCategories::all();
        $totalCat = $cat->count() + $subCat->count();
        $visite = DB::table('sessions')->orderBy('last_activity', 'desc')->paginate(25);
        $orders = Order::orderBy('placed_date', 'DESC')->paginate(10);

        $recentProduct = Product::with(['categories', 'subCategories'])->orderBy('created_at', 'desc')->take(5)->get();
        //dd($recentProduct);
        return view('adm.index', compact(
            'users', 'products', 'totalCat', 'recentProduct', 'visite', 'orders'
        ));
    }
}

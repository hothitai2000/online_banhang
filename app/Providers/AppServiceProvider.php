<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
use App\Models\Wishlists;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProductType;

use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void

    {
        view()->composer('header',function($view){
            $loai_sp = ProductType::all();
            $view->with('loai_sp',$loai_sp);
        });

         view()->composer('header', function ($view) {										
            if (Session('cart')) {					     ///nếu tồn tại sesion cart					
             $oldCart = Session::get('cart');			//kiểm tra old cart có tồn tại khum							
             $cart = new Cart($oldCart);										
             $view->with(['cart' => Session::get('cart'), 										
             'product_cart' => $cart->items, 										
             'totalPrice' => $cart->totalPrice, 										
            'totalQty' => $cart->totalQty										
            ]);
        }
        });



        
        ///--------------------WISHLIST-------------------	    
        view()->composer('header', function ($view) {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $wishlist = DB::table('products')
            ->whereIn('id', function ($query) use ($user_id) {
                $query->select('product_id')
                    ->from('wishlist')
                    ->where('user_id', $user_id);
            })
            ->get();
            
            
            $quantity = Wishlists::query()->count();
            $view ->with(['wishlist' => $wishlist , 'quantity' => $quantity]);
        }
        
    });

    }
}



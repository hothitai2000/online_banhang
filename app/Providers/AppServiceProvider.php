<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Models\ProductType;
use App\Models\Cart;

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
            if (Session('cart')) {										
             $oldCart = Session::get('cart');										
             $cart = new Cart($oldCart);										
             $view->with(['cart' => Session::get('cart'), 										
             'product_cart' => $cart->items, 										
             'totalPrice' => $cart->totalPrice, 										
            'totalQty' => $cart->totalQty										
            ]);
            ///--------------------WISHLIST-------------------
            // view()->composer('header',function($view){
            //     if (Session('user')){
            //         $user=Session::get('user');
            //         $wishlist=wishlist::where('id_user',$user->id)->get();
            //         $sumwishlist=0;
            //         $totalwishlist=0;
            //     }
            // });
         
            // }

           }	
           									
            
    });
    

}}



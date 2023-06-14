<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;

class LazadaController extends Controller
{
    public function getProduct()
    {
        $product = products::all();
        return response() ->json($product);
    }
}

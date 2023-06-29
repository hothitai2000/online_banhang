<?php

namespace App\Http\Controllers;
use App\Models\Wishlists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\WishlistController;

class WishlistController extends Controller
{
    public function getWishList()
    {
        if (!Auth::check()) {
            // User is not logged in, handle the error or redirect to login page
            return response()->json(['error' => 'User is not logged in']);
        }

        $wishlist = Wishlist::where('user_id', Auth::user()->id)->with('products')->get();

        return response()->json(['Wishlist' => $wishlist]);

    }
    public function addToWishlist(Request $request, $id)
    {
        if (!Auth::check()) {
            // User is not logged in, handle the error or redirect to login page
            return response()->json(['error' => 'User is not logged in']);
        }

        // Check if the product is already in the wishlist
        $wishlist = Wishlists::where('user_id', Auth::user()->id)->where('product_id', $id)->first();

        if ($wishlist) {
            // Product already exists in the wishlist, handle the error or display a message
            return response()->json(['error' => 'Product already exists in the wishlist']);
        }

        // Add the product to the wishlist
        Wishlists::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
        ]);

        return "<script>
        alert('Bạn đã thêm vào danh sách yêu thích');
        window.location.href = '../../page';
        </script>";
    }

    public function removeFromWishList(Request $request, $id)
    {
        if (!Auth::check()) {
            // User is not logged in, handle the error or redirect to login page
            return response()->json(['error' => 'User is not logged in']);
        }

        // Find the wishlist item by ID and user ID
        $wishlist = Wishlist::where('id', $id)->where('user_id', Auth::user()->id)->first();

        if (!$wishlist) {
            // Wishlist item not found, handle the error or display a message
            return response()->json(['error' => 'Wishlist item not found']);
        }

        // Delete the wishlist item
        $wishlist->delete();

        return response()->json(['message' => 'Product removed from wishlist']);
    }
}
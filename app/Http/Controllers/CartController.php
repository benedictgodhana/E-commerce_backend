<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\cart;
use Illuminate\Support\Facades\Session; // Import the Session facade

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        // Retrieve the authenticated user
        $user = $request->user();

        // Check if the user is authenticated
        if ($user) {
            // Check if the item is already in the cart for the user
            $existingCartItem = Cart::where('user_id', $user->id)
                                    ->where('product_id', $productId)
                                    ->first();

            if ($existingCartItem) {
                // Item is already in the cart, return an error response
                return response()->json(['error' => 'Item is already in the cart'], 400);
            }

            // Item is not in the cart, proceed with adding to cart
            $cartItem = new Cart();
            $cartItem->user_id = $user->id;
            $cartItem->product_id = $productId;
            $cartItem->save();

            // Return a success response
            return response()->json(['message' => 'Item added to cart successfully'], 200);
        } else {
            // If user is not authenticated, return an error response
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }


    public function getCartCount(Request $request)
    {
        // Retrieve the authenticated user
        $user = $request->user();

        // Check if the user is authenticated
        if ($user) {
            // Fetch the cart count for the authenticated user
            $cartCount = Cart::where('user_id', $user->id)->count();

            // Return the cart count as a response
            return response()->json( $cartCount);
        } else {
            // If user is not authenticated, return an error response
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }
    public function countSessionCartItems()
    {
        // Retrieve cart items from session and count them
        $cartItems = Session::get('cart', []);
        $cartItemCount = count($cartItems);

        return response()->json($cartItemCount);
    }

    public function getCartItems(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Fetch cart items for the authenticated user
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        // Return the cart items as JSON response
        return response()->json($cartItems);
    }
}

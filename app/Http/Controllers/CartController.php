<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Retrieve product details from the request
        $action = $request->input('action');
        $product = [
            'id' => $request->input('product_id'),
            'img' =>  $request->input('img'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'color' => $request->input('color'),
            'size' => $request->input('size'),
            'quantity' => $request->input('quantity')
        ];
        $uniqueKey = $product['id'] . '-' . $product['color'] . '-' . $product['size'];
        $cart = session()->get('cart', []);

        if (isset($cart[$uniqueKey])) {
            $cart[$uniqueKey]['quantity'] += $product['quantity'];
        } else {
            $cart[$uniqueKey] = $product;
        }
        session()->put('cart', $cart);
        if ($action == 'buy') {
            return redirect()->route('pages.cart')->with('success', 'Proceeding to checkout!');
        } else {
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
    }
    public function deletetoCart($id, $color, $size)
    {
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
        $uniqueKey = $id . '-' . $color . '-' .  $size;
        // Kiểm tra xem sản phẩm với id này có trong giỏ hàng không

        if (isset($cart[$uniqueKey])) {
            // Xóa sản phẩm khỏi giỏ hàng
            unset($cart[$uniqueKey]);

            // Cập nhật lại giỏ hàng trong session
            session()->put('cart', $cart);
        }
        // Quay lại trang trước và thông báo thành công
        return redirect()->back()->with('success', 'Product deleted from cart successfully!');
    }
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart); // Cập nhật lại session giỏ hàng
        }

        return response()->json([
            'success' => true,
            'cart' => $cart,
        ]);
    }
}

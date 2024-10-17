<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function CartPage()
    {
        return view('layout.cart');
    }
    public function IndexPage()
    {

        return view('layout.index');
    }
    public function HomePage()
    {
        $img = DB::table('album')->get();
        $cart = session()->get('cart', []);
        $countCart = count($cart);
        return view('layout.pages.home', ['data' => $img, 'count' => $countCart]);
    }
    public function AboutPage()
    {
        return view('layout.pages.about');
    }
    public function ContactPage()
    {
        $cart = session()->get('cart', []);
        $countCart = count($cart);
        return view('layout.pages.contact', ['count' => $countCart]);
    }
    public function MenPage()
    {
        return view('layout.pages.home');
    }
    public function AllPage(Request $request)
    {
        $response = Http::get('http://localhost:3000/api/data');
        if ($response->successful()) {
            $data = $response->json();


            $category = $request->input('category');
            $search = $request->input('search');
            if (($category == 'all' || !$category) && !$search) {
            } elseif ($category || $search) {
                $data = array_filter($data, function ($item) use ($category, $search) {
                    $matchCategory = !$category || $category == 'all' || stripos($item['name'], $category) !== false;

                    // Kiểm tra nếu search hợp lệ
                    $matchSearch = !$search || stripos($item['name'], $search) !== false;

                    // Trả về item nếu thỏa mãn cả category và search
                    return $matchCategory && $matchSearch;
                });
            }
            $cart = session()->get('cart', []);
            $countCart = count($cart);
            // Trả dữ liệu đã xử lý cho view
            return view('layout.pages.all', ['data' => $data, 'count' => $countCart]);
        } else {

            return view('layout.pages.all')->with('error', 'Failed to fetch data from the API.');
        }
    }
    public function KidPage()
    {
        return view('layout.pages.kid');
    }
    public function DeTailPage($name)
    {
        // Fetch data from the API, replacing ':name' with the actual product name
        $response = Http::get("http://localhost:3000/api/data/{$name}");
        if ($response->successful()) {
            // Get the data from the API response
            $data = $response->json();
            // Pass the data to the views
            $cart = session()->get('cart', []);
            $countCart = count($cart);
            return view('layout.pages.detail_pd', ['data' => $data, 'count' => $countCart]);
        } else {
            // Handle the error (optional)
            return view('layout.pages.all')->with('error', 'Failed to fetch data from the API.');
        }
    }
    public function Post()
    {
        // Gọi API để lấy dữ liệu
        $response = Http::get('http://localhost:3000/api/data');

        if ($response->successful()) {
            $data = $response->json();

            if (count($data) >= 4) {
                $randomKeys = array_rand($data, 4);
                $randomProducts = [];
                foreach ($randomKeys as $key) {
                    $randomProducts[] = $data[$key];
                }
            } else {
                // Nếu số lượng sản phẩm ít hơn 4, lấy tất cả sản phẩm
                $randomProducts = $data;
            }
            dd($randomProducts);
            // Trả về view với dữ liệu sản phẩm ngẫu nhiên
            return view('layout.component.post', ['data' => $randomProducts]);
        } else {
            // Xử lý lỗi (nếu cần)
            return view('layout.component.post')->with('error', 'Failed to fetch data from the API.');
        }
    }
    public function CheckoutPage()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 1); // Kiểm tra nếu có giá và số lượng, nếu không gán giá trị mặc định
        }
        return view('layout.checkout', ['cart' =>  $cart, 'total_main' => $total]);
    }
}

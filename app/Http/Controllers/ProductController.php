<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->middleware('auth');

        $this->client = $client;
    }

    // public function fetchProducts()
    // {
    //     $client = new Client();
    //     $products = [];

    //     // Fetch 10 products per request, covering the first 3 pages
    //     for ($page = 1; $page <= 3; $page++) {
    //         $response = $client->get("https://dummyjson.com/products?page=$page&limit=10");
    //         $data = json_decode($response->getBody(), true);
    //         $products = array_merge($products, $data);
    //     }

    //     // Save products to database or perform any other actions

    //     return response()->json(['message' => 'Products fetched successfully']);
    // }   
    public function fetchProducts()
    {
        $client = new Client();
        $existingProducts = Product::pluck('id')->toArray();
        $newProducts = [];

        // Fetch 10 products per request, covering the first 3 pages
        for ($page = 1; $page <= 3; $page++) {
            $response = $client->get("https://dummyjson.com/products?page=$page&limit=10");
            $data = json_decode($response->getBody(), true);
          
        


            foreach ($data['products'] as $product) {
                var_dump($product);
                // Check if the product already exists in the database
                if (!in_array($product['id'], $existingProducts)) {
                    // Save the product to the database or perform any other actions
                    Product::create([
                        'id' => $product['id'],
                        'title' => $product['title'],
                        'description' => $product['description'],
                        'price' => $product['price'],
                        'discountPercentage' => $product['discountPercentage'],
                        'rating' => $product['rating'] ? $product['rating']: 0 ,
                        'stock' => $product['stock'],
                        'brand' => $product['brand'],
                        'category' => $product['category'],
                        'thumbnail' => $product['thumbnail'],
                        'images' => json_encode($product['images']),
                        // Add other fields as needed
                    ]);
var_dump($product);
                    $newProducts[] = $product;
                }
            }
        }

        return response()->json(['message' => 'Products fetched and updated successfully', 'new_products' => $newProducts]);
    }
    


    /**
     * Show the Product list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::paginate(5);

        return view('products.index', compact('products'));
    }
}

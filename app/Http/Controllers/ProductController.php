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

 
    public function fetchProducts()
    {
        try {
            $client = new Client();
            $existingProducts = Product::pluck('id')->toArray();
            $newProducts = [];
            $product_url=config('constants.EXTERNAL_PRODUCT_URL');
            $no_of_page=config('constants.NUMBER_OF_PAGE_FETCH');
            $limit=config('constants.FETCH_PRODUCTS_PER_REQUEST');

            // Fetch 10 products per request, covering the first 3 pages
            for ($page = 1; $page <= $no_of_page; $page++) {
                $response = $client->get("$product_url?page=$page&limit=$limit");
                $data = json_decode($response->getBody(), true);       
                foreach ($data['products'] as $product) {              
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
                        $newProducts[] = $product;
                    }
                }
            }

            return response()->json(['message' => 'Products fetched and updated successfully', 'new_products' => $newProducts]);
        } catch (\Exception $e) {
            // Handle the exception and send an error response
            return response()->json(['error' => 'An error occurred', 'message' => $e->getMessage()], 500);
        }
    }
    


    /**
     * Show the Product list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $limit=config('constants.PRODUCTS_PER_PAGE');
        $products = Product::paginate($limit);

        return view('products.index', compact('products'));
    }
}

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


    public function getProductFromThirdParty()
    {
        $response = $this->client->get(env('PRODUCT_API_URL'));

        return $response->getBody()->getContents()->products;
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

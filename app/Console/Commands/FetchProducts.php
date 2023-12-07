<?php

namespace App\Console\Commands;

use App\Http\Controllers\ProductController;
use Illuminate\Console\Command;

class FetchProducts extends Command
{
    protected $signature = 'products:fetch';

    protected $description = 'Fetch products from DummyJSON API';

    public function handle(ProductController $productController)
    {
        $productController->fetchProducts();
        $this->info('Products fetched successfully.');
    }
}
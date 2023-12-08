<?php

namespace App\Console\Commands;

use App\Http\Controllers\ProductController;
use Illuminate\Console\Command;

class FetchProductsScheduler extends Command
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch products from DummyJSON API';

     /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle(ProductController $productController)
    {
        $productController->fetchProducts();
        $this->info('Products fetched successfully.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index () {

        $products = Product::with('category');

        if(request('category')){
            $products = Product::whereHas('category', function (Builder $query) {
                $query->where('name', request('category'));
            })->with('category');
        }

        return new ProductResource($products->get());
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleCrontroller extends Controller
{
    public function index()
    {
        $sales = Sale::paginate(30);
        foreach ($sales as $sale) {
            $sale->customer;
        }
        return $sales;
    }

    public function filter(Request $request)
    {
        $sales = Sale::id($request->id)
            ->cliente($request->cliente)
            ->orderBy('num_venta', 'asc')
            ->paginate(30);
        foreach ($sales as $sale) {
            $sale->customer;
            $productsSale = $sale->productsSale;
            foreach ($productsSale as $productSale) {
                $productSale->product;
            }
        }
        return $sales;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $produc = Product::all();
        return $produc;
    }

    public function store() {}

    public function create() {}

    public function show() {
        
    }

    public function update() {}

    public function destroy() {}

    public function edit() {}
}

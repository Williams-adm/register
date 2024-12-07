<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        return $category;
    }

    public function store(){
        
    }

    public function create(){

    }
    
    public function show(Category $category){
        
    }

    public function update(){

    }

    public function destroy(){

    }

    public function edit(){

    }

}

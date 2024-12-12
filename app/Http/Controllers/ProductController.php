<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request) {
        try{
            $perPage = $request->get('per_page', 15);
            $page = $request->get('page', 1);
            if (!is_numeric($perPage) || $perPage <= 0) {
                return response()->json(['error' => 'El valor de "per_page" debe ser un número mayor que 0.'], 400);
            }
            $products = Product::paginate($perPage);
            return view('modules.products.listProduct', compact('products', 'page'));

        } catch (QueryException $e) {
            Log::error('Error al intentar listar los productos: ' . $e->getMessage());
            return response()->json(['error' => 'Error al intentar listar el producto'], 400);

        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }
    
    public function create(Request $request) {
        try {
            $currentPage = $request->get('page', 1);
            $categories = Category::all();
            return view('modules.products.createProduct', compact('categories', 'currentPage'));
        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }
    
    public function store(StoreProductRequest $request) {
        try {
            $name = $request->input('name');
            $photo_path = null;

            if ($request->hasFile('photo_path')) {
                $imageName = Str::slug($name) . '.' . $request->file('photo_path')->getClientOriginalExtension();
                $photo_path = $request->file('photo_path')->storeAs('Product', $imageName, 'public');
            }

            Product::create([
                'name' => $name,
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'stock' => $request->input('stock'),
                'discount' => $request->input('discount'),
                'photo_path' => $photo_path,
                'category_id' => $request->input('category_id'),
            ]);

            return redirect()->route('products.create')->with('success', 'Product created successfully');
        } catch (QueryException $e) {
            Log::error('Error al intentar crear el producto: ' . $e->getMessage());
            return response()->json(['error' => 'Error al crear el producto'], 400);
        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }

    public function show(Product $product, Request $request) {
        try {
            $currentPage = $request->get('page', 1);
            $showCategory = (new ProductResource($product))->toArray(request());
            return view('modules.products.showProduct', compact('showCategory', 'currentPage'));
        } catch (QueryException $e) {
            Log::error('Error al intentar ver en detalle la categoría: ' . $e->getMessage());
            return response()->json(['error' => 'Error al intentar ver en detalle la categoría'], 400);
        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }
    

    public function edit(Product $product, Request $request) {
        try {
            $currentPage = $request->get('page', 1);
            $categories = Category::all();
            return view('modules.products.editProduct', compact('product', 'categories', 'currentPage'));
        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }

    public function update(UpdateProductRequest $request, Product $product) {
        try {
            $name = $request->input('name', $product->name);
            $description = $request->input('description', $product->description);
            $price = $request->input('price', $product->price);
            $stock = $request->input('stock', $product->stock);
            $discount = $request->input('discount', $product->discount);
            $category_id = $request->input('category_id', $product->category_id);
            $photo_path = $product->photo_path;

            $changes = [
                'name' => $name !== $product->name,
                'description' => $description !== $product->description,
                'price' => $price !== $product->price,
                'stock' => $stock != $product->stock,
                'discount' => $discount !== $product->discount,
                'category_id' => $category_id != $product->category_id,
                'photo_path' => $request->hasFile('photo_path')
            ];

            if (!in_array(true, $changes)) {
                return redirect()->route('products.edit', $product->id)->with('info', 'There were no changes in the category');
            }

            if ($changes['photo_path']) {
                if ($product->photo_path) {
                    Storage::disk('public')->delete($product->photo_path);
                }
                $imageName = Str::slug($name) . '.' . $request->file('photo_path')->getClientOriginalExtension();
                $photo_path = $request->file('photo_path')->storeAs('Product', $imageName, 'public');
            } elseif ($changes['name'] && $product->photo_path) {
                // Renombrar imagen si solo cambió el nombre
                $extension = pathinfo($product->photo_path, PATHINFO_EXTENSION);
                $newImageName = 'Product/' . Str::slug($name) . '.' . $extension;
                Storage::disk('public')->move($product->photo_path, $newImageName);
                $photo_path = $newImageName;
            }

            $product->update([
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'stock' => $stock,
                'discount' => $discount,
                'category_id' => $category_id,
                'photo_path' => $photo_path
            ]);
            return redirect()->route('products.edit', $product->id)->with('success', 'Product updated successfully');
        } catch (QueryException $e) {
            Log::error('Error al intentar actualizar el producto: ' . $e->getMessage());
            return response()->json(['error' => 'Error al intentar actualizar el producto'], 400);
        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }

    public function destroy(Product $product) {
        try {
            if ($product->photo_path) {
                Storage::disk('public')->delete($product->photo_path);
            }
            $product->delete();

            $currentPage = request()->get('page', 1);
            return redirect()->route('products.index', ['page' => $currentPage])->with('success', 'Product deleted successfully');

        } catch (QueryException $e) {
            Log::error('Error al intentar eliminar la categoría: ' . $e->getMessage());
            return response()->json(['error' => 'Error al intentar eliminar la categoría'], 400);
            
        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }
}

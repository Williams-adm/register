<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request){
        try{
            $perPage = $request->get('per_page', 15);
            $page = $request->get('page', 1);
            if (!is_numeric($perPage) || $perPage <= 0) {
                return response()->json(['error' => 'El valor de "per_page" debe ser un número mayor que 0.'], 400);
            }
            $categories = Category::paginate($perPage);
            return view('modules.categories.listCategory', compact('categories', 'page'));

        } catch (QueryException $e) {
            Log::error('Error al intentar listar la categoría: ' . $e->getMessage());
            return response()->json(['error' => 'Error al intentar listar la categoría'], 400);

        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }
    
    public function create(Request $request){
        try{
            $currentPage = $request->get('page', 1);
            return view('modules.categories.createCategory', compact('currentPage'));

        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }

    public function store(StoreCategoryRequest $request){
        try{
            $name = $request->input('name');
            $image_path = null;
    
            if($request->hasFile('image_path')){
                $imageName = Str::slug($name) . '.' . $request->file('image_path')->getClientOriginalExtension();
                $image_path = $request->file('image_path')->storeAs('Category', $imageName, 'public');
            }
    
            Category::create([
                'name' => $name,
                'description' => $request->input('description'),
                'image_path' => $image_path
            ]);
    
            return redirect()->route('categories.create')->with('success', 'Category created successfully');

        } catch (QueryException $e) {
            Log::error('Error al intentar crear la categoría: ' . $e->getMessage());
            return response()->json(['error' => 'Error al crear la categoría'], 400);

        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }

    public function show(Category $category, Request $request){
        try{
            $currentPage = $request->get('page', 1);
            $showCategory = (new CategoryResource($category))->toArray(request());
            return view('modules.categories.showCategory', compact('showCategory', 'currentPage'));

        } catch (QueryException $e) {
            Log::error('Error al intentar ver en detalle la categoría: ' . $e->getMessage());
            return response()->json(['error' => 'Error al intentar ver en detalle la categoría'], 400);

        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }

    public function edit(Category $category, Request $request){
        try{
            $currentPage = $request->get('page', 1);
            return view('modules.categories.editCategory', compact('category', 'currentPage'));

        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }

    public function update(UpdateCategoryRequest $request, Category $category){
        try {
            $name = $request->input('name', $category->name);
            $description = $request->input('description', $category->description);
            $image_path = $category->image_path;

            $changes = [
                'name' => $name !== $category->name,
                'description' => $description !== $category->description,
                'image_path' => $request->hasFile('image_path')
            ];

            if (!in_array(true, $changes)) {
                return redirect()->route('categories.edit', $category->id)->with('info', 'There were no changes in the category');
            }

            if ($changes['image_path']) {
                if ($category->image_path) {
                    Storage::disk('public')->delete($category->image_path);
                }
                $imageName = Str::slug($name) . '.' . $request->file('image_path')->getClientOriginalExtension();
                $image_path = $request->file('image_path')->storeAs('Category', $imageName, 'public');
            } elseif ($changes['name'] && $category->image_path) {
                // Renombrar imagen si solo cambió el nombre
                $extension = pathinfo($category->image_path, PATHINFO_EXTENSION);
                $newImageName = 'Category/' . Str::slug($name) . '.' . $extension;
                Storage::disk('public')->move($category->image_path, $newImageName);
                $image_path = $newImageName;
            }

            $category->update([
                'name' => $name,
                'description' => $description,
                'image_path' => $image_path
            ]);

            return redirect()->route('categories.edit', $category->id)->with('success', 'Category updated successfully');

        } catch (QueryException $e) {
            Log::error('Error al intentar actualizar la categoría: ' . $e->getMessage());
            return response()->json(['error' => 'Error al intentar actualizar la categoría'], 400);

        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }

    public function destroy(Category $category){
        try{
            if ($category->image_path) {
                Storage::disk('public')->delete($category->image_path);
            } 
            $category->delete();

            $currentPage = request()->get('page', 1);
            return redirect()->route('categories.index', ['page' => $currentPage])->with('success', 'Category deleted successfully');

        }catch(QueryException $e){
            Log::error('Error al intentar eliminar la categoría: ' . $e->getMessage());
            return response()->json(['error' => 'Error al intentar eliminar la categoría'], 400);
            
        } catch (Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return response()->json(['error' => 'Error inesperado.'], 500);
        }
    }
}
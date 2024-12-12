@extends('templates.updateForm')

@section('title', 'Editar Productos')

@section('back', route('products.index'))

@section('formAction', route('products.update', $product))

@section('formContent')
<label class="block">Nombre:
    <input type="text" name="name"placeholder="Luminarias" class="block" value="{{ old('name', $product->name) }}" required>
</label>

<label class="block">Descripción:
    <textarea name="description" rows="8" wrap="soft" class="block  mb-4 resize-none rounded-md" placeholder="Esta es una .." required>{{ old('description', $product->description) }}</textarea>
</label>

<label class="block">Categoría:
    <select name="category_id" class="block" required>
        <option value="" disabled selected>Seleccione</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id,', $product->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</label>

<label class="block">Stock:
    <input type="number" name="stock" placeholder="2" class="block" value="{{ old('stock', $product->stock) }}" required min="1" step="1">
</label>

<label class="block">Precio:
    <input type="number" name="price" placeholder="S/. 20.00" class="block" value="{{ old('price', $product->price) }}" required min="1" step="0.01">
</label>

<label class="block">Descuento:
    <input type="number" name="discount" placeholder="0.05 %" class="block" value="{{ old('discount', $product->discount) }}" required min="0" step="0.01">
</label>

<label>Imagen:
    @if($product->photo_path)
    <div class="mt-2">
        <img src="{{ asset('storage/' . $product->photo_path) }}" alt="Imagen de categoría" class="h-32 w-auto mt-2">
    </div>
    @endif
    <input type="file" name="photo_path">
</label>
@endsection
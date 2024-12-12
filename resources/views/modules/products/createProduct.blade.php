@extends('templates.createForm')

@section('title', 'Crear Productos')

@section('back', route('products.index', ['page' => $currentPage]))

@section('formAction', route('products.store'))

@section('formContent')
<label class="block">Nombre:
    <input type="text" name="name" placeholder="Luminarias" class="block" value="{{ old('name') }}" required>
</label>
<label class="block">Descripción:
    <textarea name="description" rows="8" wrap="soft" class="block  mb-4 resize-none rounded-md" placeholder="Esta es una .." required>{{ old('description') }}</textarea>
</label>
<label class="block">Categoría:
    <select name="category_id" class="block" required>
        <option value="" disabled selected>Seleccione</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</label>
<label class="block">Stock:
    <input type="number" name="stock" placeholder="2" class="block" value="{{ old('stock') }}" required min="1" step="1">
</label>
<label class="block">Precio:
    <input type="number" name="price" placeholder="S/. 20.00" class="block" value="{{ old('price') }}" required min="1" step="0.01">
</label>
<label class="block">Descuento:
    <input type="number" name="discount" placeholder="0.05 %" class="block" value="{{ old('discount') }}" required min="0" step="0.01">
</label>
<label>Imagen:
    <input type="file" name="photo_path">
</label>
@endsection
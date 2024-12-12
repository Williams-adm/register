@extends('templates.updateForm')

@section('title', 'Editar Categoria')

@section('back', route('categories.index', ['page' => $currentPage]))

@section('formAction', route('categories.update', $category))

@section('formContent')
<label class="block">Nombre:
    <input type="text" name="name"placeholder="Luminarias" class="block" value="{{ old('name', $category->name) }}" required>
</label>
<label class="block">Descripción:
    <textarea name="description" rows="8" wrap="soft" class="block  mb-4 resize-none rounded-md" placeholder="Esta es una .." required>{{ old('description', $category->description) }}</textarea>
</label>
<label>Imagen:
    @if($category->image_path)
    <div class="mt-2">
        <img src="{{ asset('storage/' . $category->image_path) }}" alt="Imagen de categoría" class="h-32 w-auto mt-2">
    </div>
    @endif
    <input type="file" name="image_path">
</label>
@endsection
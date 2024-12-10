@extends('templates.createForm')

@section('title', 'Crear Categoria')

@section('back', route('categories.index'))

@section('formAction', route('categories.store'))

@section('formContent')
<label class="block">Nombre:
    <input type="text" name="name"placeholder="Luminarias" class="block" value="{{ old('name') }}" required>
</label>
<label class="block">Descripción:
    <textarea name="description" rows="8" wrap="soft" class="block  mb-4 resize-none rounded-md" placeholder="Esta es una .." required>{{ old('description') }}</textarea>
</label>
<label>Imagen:
    <input type="file" name="image_path">
</label>
@endsection
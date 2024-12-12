@extends('templates.show')

@section('title', 'Ver Categoria')

@section('back', route('categories.index', ['page' => $currentPage]))

@section('content')
    <div>
        <h2>{{$showCategory['name']}}</h2>
        <img src="{{ $showCategory['image_path'] ? asset('storage/' . $showCategory['image_path']) : asset('assets/img/no-image.jpg') }}" alt="{{'imagen de' . $showCategory['name']}}">
        <h3>Descripcion: </h3>
        <p>{{$showCategory['description']}}</p>
        <h3>Fecha de Creación: </h3>
        <p>{{ $showCategory['created_at'] }}</p>
        <h3>Ultima Actualización: </h3>
        <p>{{ $showCategory['updated_at'] }}</p>
    </div>
@endsection
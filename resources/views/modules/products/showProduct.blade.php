@extends('templates.show')

@section('title', 'Ver producto')

@section('back', route('products.index', ['page' => $currentPage]))

@section('content')
    <div>
        <h2>{{$showCategory['name']}}</h2>
        <img src="{{ $showCategory['photo_path'] ? asset('storage/' . $showCategory['photo_path']) : asset('assets/img/no-image.jpg') }}" alt="{{'imagen de' . $showCategory['name']}}">
        <h3>Descripcion: </h3>
        <p>{{$showCategory['description']}}</p>
        <h3>Categoría: </h3>
        <p>{{$showCategory['category']}}</p>
        <h3>Stock: </h3>
        <p>{{$showCategory['stock']}}</p>
        <h3>Precio: </h3>
        <p>S/. {{$showCategory['price']}}</p>
        <h3>Descuento: </h3>
        <p>{{$showCategory['discount']}} %</p>
        <h3>Fecha de Creación: </h3>
        <p>{{ $showCategory['created_at'] }}</p>
        <h3>Ultima Actualización: </h3>
        <p>{{ $showCategory['updated_at'] }}</p>
    </div>
@endsection
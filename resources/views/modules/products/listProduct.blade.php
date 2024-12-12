@extends('templates.listIndex')

@section('title', 'Lista de Productos')

@section('buttonCreate', route('products.create', ['page' => request()->get('page', 1)]))

@if ($products->isEmpty())
    @section('empty')
        <h1>No hay productos agregados</h1>
    @endsection
@else
    @section('encabezadoTabla')
    <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-center">#</th>
    <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-center">Foto</th>
    <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-center">Nombre</th>
    <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-center">Categoria</th>
    <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-center">Stock</th>
    <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-center">Precio</th>
    <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-center">Descuento</th>
    <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-center">Opciones</th>
@endsection

@section('contenidoTabla')
    <tbody class="bg-white">
        @foreach ($products as $product)
        <tr class="border-b hover:bg-gray-100">
            <td class="px-4 py-2 text-sm text-gray-800">{{ $products->firstItem() + $loop->iteration - 1 }}</td>
            <td class="px-4 py-2 w-24">
                <img class="rounded-lg shadow-md h-14 w-24" src="{{ $product->photo_path ? asset('storage/' . $product->photo_path) : asset('assets/img/no-image.jpg') }}" alt="Imagen de producto">
            </td>
            <td class="px-4 py-2 text-sm text-gray-800">{{$product->name}}</td>
            <td class="px-4 py-2 text-sm text-gray-800">{{ $product->category->name ?? 'Categoría no asignada' }}</td>
            <td class="px-4 py-2 text-sm text-gray-800">{{$product->stock}}</td>
            <td class="px-4 py-2 text-sm text-gray-800">S/. {{$product->price}}</td>
            <td class="px-4 py-2 text-sm text-gray-800">{{$product->discount}} %</td>
            <td class="px-4 py-2 text-sm text-gray-800">
                <a href="{{ route('products.show', [$product->id, 'page' => request()->get('page', 1)]) }}" class="bg-orange-300 p-2 rounded-lg">Ver</a>
                <a href="{{ route('products.edit', [$product->id, 'page' => request()->get('page', 1)]) }}" class="bg-orange-300 p-2 rounded-lg">Editar</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="page" value="{{ request()->get('page', 1) }}">
                    <button type="submit" class="bg-orange-300 p-2 rounded-lg" onclick="return confirm('¿Estas seguro?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
@endsection

@section('content')
    <div>{{ $products->links() }}</div>
@endsection
@endif
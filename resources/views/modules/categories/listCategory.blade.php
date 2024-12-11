@extends('templates.listIndex')

@section('title', 'Lista de Categorias')

@section('buttonCreate', route('categories.create'))

@if ($categories->isEmpty())
    @section('empty')
        <h1>No hay categorias agregadas</h1>
    @endsection
@else
    @section('encabezadoTabla')
    <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-center">#</th>
    <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-center">Foto</th>
    <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-center">Nombre</th>
    <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-center">Opciones</th>
@endsection

@section('contenidoTabla')
    <tbody class="bg-white">
        @foreach ($categories as $category)
        <tr class="border-b hover:bg-gray-100">
            <td class="px-4 py-2 text-sm text-gray-800">{{ $categories->firstItem() + $loop->iteration - 1 }}</td>
            <td class="px-4 py-2 w-24">
                <img class="rounded-lg shadow-md h-14 w-24" src="{{ $category->image_path ? asset('storage/' . $category->image_path) : asset('assets/img/no-image.jpg') }}" alt="Imagen de categoría">
            </td>
            <td class="px-4 py-2 text-sm text-gray-800">{{$category->name}}</td>
            <td class="px-4 py-2 text-sm text-gray-800">
                <a href="{{ route('categories.show', $category->id) }}" class="bg-orange-300 p-2 rounded-lg">Ver</a>
                <a href="{{ route('categories.edit', $category->id) }}" class="bg-orange-300 p-2 rounded-lg">Editar</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
    <div>{{ $categories->links() }}</div>
@endsection
@endif
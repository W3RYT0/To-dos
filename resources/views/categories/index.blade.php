@extends('app')
@section('content')
<div class="container w-25 border p-4 mt-4">
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        @if (session('success'))
        <h6 class="alert alert-success">{{session('success')}}</h6>
        @endif
        @error('name')
        <h6 class="alert alert-danger">{{$message}}</h6>
        @enderror
        <div class="mb-3">
            <label for="name" class="form-label">Escribe la categria:</label>
            <input name="name" type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color de la categoria</label>
            <input name="color" type="color" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Agregar Categoria</button>
    </form>
    @foreach($categories as $category)
    <div class="row py-1">
        <div class="col-md-9 d-flex align-items-center">
            <a class="d-flex align-items-center gap-2" href="{{ route('categories.show',['category' => $category->id] )}}">
                <div style="background: {{ $category->color }} ">
                    <span class="color-container m-2"></span>
                </div>
                {{ $category->name }}
            </a>
        </div>
        <div class="col-md-3 d-flex justify-content-end">
            <!-- <form action="{{ route('categories.destroy', [$category->id]) }}" method="post">
                @method('DELETE')
                @csrf -->
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $category->id }}">Eliminar</button>
            <!-- </form> -->
        </div>
    </div>
     <!-- Modal -->
     <div class="modal fade" id="modal{{ $category->id }}" tabindex="-1" aria-labelledby="modal{{ $category->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atención</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Al eliminar la categoria <strong>{{ $category->name }}</strong> se eliminarán todas sus tareas.
                    <h6>¿Estas seguro de elimiar la categoría?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <form action="{{ route('categories.destroy', [$category->id]) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
   
    @endforeach
</div>
@endsection
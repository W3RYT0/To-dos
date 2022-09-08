@extends('app')

@section('content')
<div class="container w-25 border p-4 mt-4">
    <form action="{{ route('todos') }}" method="POST">
        @csrf
        @if (session('success'))
            <h6 class="alert alert-success">{{session('success')}}</h6>
        @endif
        @error('title')
            <h6 class="alert alert-danger">{{$message}}</h6>
        @enderror
        <div class="mb-3">
            <label for="title" class="form-label">Escribe la nueva tarea:</label>
            <input name="title" type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Selecciona la Categoría:</label>
            <select class="form-select" aria-label="Default select example" name="category">
            @foreach ($categories as $category)                
                    <option value="{{ $category->id}}" style="background-color:{{ $category->color}};">{{ $category->name }}</option>                
            @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Tarea</button>
    </form>

    @foreach($todos as $todo)
        <div class="row py-1">
            <div class="col-md-9 d-flex align-items-center">
                <a href="{{ route('todos-edit',['id'=>$todo->id] )}}">{{ $todo->title }}</a>
            </div>
            <div class="col-md-3 d-flex justify-content-end">
                <form action="{{ route('todos-destroy', [$todo->id]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
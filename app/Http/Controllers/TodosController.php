<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * index para mostrar todos los datos
     * store para guardar registros
     * update para actualizar datos
     * destroy para eliminar datos 
     * edit para mostrar formulario para editar datos 
     */

    public function store(Request $request){
        
        $request->validate([
            'title'   => 'required|min:3',
            'category'=> 'required' 
        ]);

        $todo = new Todo;
        $todo->title      = $request->title;
        $todo->category_id= $request->category; 
        $todo->save();

        return redirect()->route('todos')->with('success', 'Tarea creada correctamente');
    }

    public function index(){
        $todos = Todo::all();
        $categories = Category::all();

        return view('todos.index', ['todos' => $todos, 'categories' => $categories]);
    }
    
    public function show($id){
        $todo = Todo::find($id);
        return view('todos.show', ['todo' => $todo]);
    }
    
    public function update(Request $request,$id){
        $todo = Todo::find($id);
        $todo->title = $request->title;
        // dd($request); //Verificar datos de entrada
        $todo->save();
        return redirect()->route('todos')->with('success', 'Tarea actualizada!');

    }
    
    public function destroy($id){
        $todo = Todo::find($id);
        $todo->delete();

        return redirect()->route('todos')->with('success', 'Tarea eliminada!');
    }
}

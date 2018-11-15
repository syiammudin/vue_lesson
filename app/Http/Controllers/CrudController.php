<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crud ;

class CrudController extends Controller
{

    public function index()
    {
        return Crud::orderBy('id','desc')->get() ;
    }

    public function store(Request $request)
    {
        $input = $request->all() ;
        $crud = Crud::create($input) ;

        return $crud ;
    }

    public function update(Request $request, $id)
    {
        $crud = Crud::find($id) ;
        $crud->completed = $request->completed ;
        $crud->update() ;

        return $crud ;
    }

    public function destroy($id)
    {
        $crud = Crud::find($id) ;
        $crud->delete() ;

        return 204 ;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog ;

class BlogController extends Controller
{

    public function index()
    {
        return Blog::orderBy('id','desc')->paginate(5);
    }

    public function store(Request $request)
    {
        $blog = Blog::create($request->all()) ;
        return $blog ;
    }

    public function edit($id)
    {
        return Blog::find($id) ;
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id) ;
        $blog->update($request->all());
        return $blog ;
    }

    public function destroy($id)
    {
         Blog::find($id)->delete() ;
        $blog = Blog::get()->count() % 5;

        return $blog ;
    }
}

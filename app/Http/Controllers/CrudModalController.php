<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog ;

class CrudModalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ;
        return Blog::when($request->search, function($query) use ($request) {
                return $query->where('title', 'like', '%'.$request->search.'%')
                    ->orWhere('content', 'like', '%'.$request->search.'%');
            })->orderBy('id','desc')->paginate(5) ;
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $blog = Blog::create($request->all()) ;
        return $blog ;
    }

    public function edit($id)
    {
        $blog = Blog::find($id) ;
        return $blog ;
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($request->all()) ;
        return $blog ;
    }

    public function destroy($id)
    {
        Blog::find($id)->delete() ;
        return 204 ;
    }
}

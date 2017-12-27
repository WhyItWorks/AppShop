<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use App\Product;
use App\ProductImage;
use App\CartDetail;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('name')->paginate(10);
        return view('admin.categories.index')->with(compact('categories')); //listado
    }
    public function create()
    {
        return view('admin.categories.create'); //formulario
    }
    public function store(Request $request)
    {
   
        $this->validate($request, Category::$rules, Category::$messages);
        Category::create($request->all()); //Asignación masiva
        //<=>
        // $category = new Category();
        // $category->name = $request->input('name');
        // $category->description = $request->input('description');                
        // $category->save();

        return redirect('/admin/categories');
    }

    public function edit(Category $category)
    {        
        //$category = Category::find($id);
        return view('admin.categories.edit')->with(compact('category')); //formulario
    }
    public function update(Request $request, Category $category)
    {
 
        $this->validate($request, Category::$rules, Category::$messages);
        $category->update($request->all());
        //<=>
        // $category = Category::find($id);
        // $category->name = $request->input('name');
        // $category->description = $request->input('description');        
        // $category->save();
        return redirect('/admin/categories');
    }
    public function destroy(Category $category)
    {   
        
        $products = Product::where('category_id', $category->id)->get();        
          foreach ($products as $product) {                                                 
                $product->category_id = null;
                $product->save();
          }          

        $category->delete();
        return redirect('/admin/categories');
    }

}

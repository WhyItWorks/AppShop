<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use App\Product;
use App\ProductImage;
use App\CartDetail;
use File;

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
        $category = Category::create($request->only('name', 'description')); //Asignación masiva

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/images/categories';
            $fileName = uniqid() . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
             if($moved){                  
                 $category->image = $fileName;                 
                 $category->save();
             }
        }
        
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
        $category->update($request->only('name', 'description'));//Asignación masiva

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/images/categories';
            $fileName = uniqid() . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
             if($moved){
                 
                 $previusPath = $path . '/' . $category->image ;
                 $category->image = $fileName;                 
                 $save = $category->save();

                if($save)
                 File::delete($previusPath);

             }
        }    
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

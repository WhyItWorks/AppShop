<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\ProductImage;
use App\CartDetail;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.index')->with(compact('products')); //listado
    }
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create')->with(compact('categories')); //formulario
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0',
        ];
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para el producto',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
            'description.required' => 'La descripción es un campo obligatorio',
            'description.max' => 'La descripción corta solo admite hasta 200 caracteres',
            'price.required' => 'Es obligatoriodefinir un precio para el producto',
            'price.numeric' => 'Ingrese un precio válido',
            'price.min' => 'No se admiten valores negativos'

        ];
        $this->validate($request, $rules, $messages);
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        
        $cat_id = ( $request->category_id == 0 ) ? null : $request->category_id;
        $product->category_id = $cat_id;
        
        $product->save();

        return redirect('/admin/products');
    }

    public function edit($id)
    {        
        $product = Product::find($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit')->with(compact('product','categories')); //formulario
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0',
        ];
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para el producto',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
            'description.required' => 'La descripción es un campo obligatorio',
            'description.max' => 'La descripción corta solo admite hasta 200 caracteres',
            'price.required' => 'Es obligatoriodefinir un precio para el producto',
            'price.numeric' => 'Ingrese un precio válido',
            'price.min' => 'No se admiten valores negativos'

        ];
        $this->validate($request, $rules, $messages);
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        
        $cat_id = ( $request->category_id == 0 ) ? null : $request->category_id;
        $product->category_id = $cat_id;

        $product->save();

        return redirect('/admin/products');
    }
    public function destroy($id)
    {
        CartDetail::where('product_id', $id)->delete();
        ProductImage::where('product_id', $id)->delete();     

        $product = Product::find($id);     
        $product->delete();
        return redirect('/admin/products');
    }


}

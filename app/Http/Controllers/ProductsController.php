<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
  }

  public function index()

  {
    $products = Product::orderBy('name')->get();
    return view('products.index', compact('products'));

  }

  public function show($id) //Product::find(Joker/Wildcard);

  {
    $product = Product::findOrFail($id);
    return view('products.show', compact('product'));

  }

  public function showName($id)
  {
    return Product::findOrFail($id)->get('name');
  }

  public function showValue($id)
  {
    return Product::findOrFail($id)->get('value');
  }

  public function create()

  {

    return view('products.create');

  }

  public function store()

  {

    $rules = array(
      'name'       => 'required',
      'value' => 'required|numeric'
    );

    $messages = [
    'required'    => 'O campo :attribute é necessário.',
    'numeric'    => 'O campo :attribute só aceita números'
    ];

    $validator = Validator::make(request()->all(), $rules, $messages);

    // process the login
    if ($validator->fails()) {
      return redirect('products/create')
      ->withErrors($validator);
    } else {

      Product::create([
        'name' => request('name'),
        'value' => request('value')
      ]);

      return redirect('products');
    }
  }

  public function edit($id)
  {
    $product = Product::findOrFail($id);
    return view('products.edit')->with('product', $product);
  }

  public function update($id)
  {
    $rules = array(
      'name'       => 'required',
      'value' => 'required|numeric'
    );

    $messages = [
    'required'    => 'O campo :attribute é necessário.',
    'numeric'    => 'O campo :attribute só aceita números'
    ];

    $validator = Validator::make(request()->all(), $rules, $messages);

    // process the login
    if ($validator->fails()) {
      return redirect('product/' . $id . '/edit')
      ->withErrors($validator);
    } else {
      // store
      $product = Product::find($id);
      $product->name       = request()->get('name');
      $product->value      = request()->get('value');
      $product->save();

      return redirect('products');
    }

    //return redirect('products', compact('products'));
  }

    public function delete($id){
      $product = Product::findOrFail($id);
      Product::delete($product);
    }



}

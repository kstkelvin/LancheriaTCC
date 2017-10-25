<?php

namespace App\Http\Controllers;

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
      'name.required'    => 'O nome é necessário.',
      'value.required'    => 'O preço é necessário.',
      'numeric'    => 'O preço só aceita digitos numerais.'
    ];

    $validator = Validator::make(request()->all(), $rules, $messages);

    // process the login
    if ($validator->fails()) {
      return redirect('produtos/adicionar')
      ->withErrors($validator);
    } else {

      Product::create([
        'name' => request('name'),
        'value' => request('value'),
        'stock' => '0'
      ]);

      return redirect('produtos');
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
      'name.required'    => 'O nome é necessário.',
      'value.required'    => 'O preço é necessário.',
      'numeric'    => 'O preço só aceita digitos numerais.'
    ];

    $validator = Validator::make(request()->all(), $rules, $messages);

    // process the login
    if ($validator->fails()) {
      return redirect('produto/' . $id . '/editar')
      ->withErrors($validator);
    } else {
      // store
      $product = Product::find($id);
      $product->name       = request()->get('name');
      $product->value      = request()->get('value');
      $product->save();

      return redirect('produtos');
    }

  }


  public function destroy($id){
    Product::destroy($id);
    return redirect('/produtos');
  }



}

<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{

    public function index()
    {

    }

    public function edit($id)
    {
      $product = Product::findOrFail($id);
      return view('products.stock')->with('product', $product);
    }


    public function update($id)
    {
      $rules = array(
        'stock' => 'required|numeric'
      );

      $messages = [
      'required'    => 'O campo :attribute é necessário.',
      'numeric'    => 'O campo :attribute só aceita números'
      ];

      $validator = Validator::make(request()->all(), $rules, $messages);

      // process the login
      if ($validator->fails()) {
        return redirect('produto/' . $id)
        ->withErrors($validator);
      } else {
        // store
        $product = Product::find($id);
        $product->stock += request()->get('stock');
        $product->save();

        return redirect('produtos');
      }

      //return redirect('products', compact('products'));
    }


    public function show($id)
    {

    }

    public function destroy($id)
    {

    }
}

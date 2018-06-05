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
      'required'    => 'O estoque não pode ficar em branco.',
      'numeric'    => 'O estoque só aceita dígitos numéricos.'
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

        return redirect('produto/' . $id)->with('success','Estoque atualizado com sucesso!');
      }

      //return redirect('products', compact('products'));
    }


    public function destroy($id)
    {
      $rules = array(
        'stock' => 'required|numeric'
      );

      $messages = [
      'required'    => 'O estoque não pode ficar em branco.',
      'numeric'    => 'O estoque só aceita dígitos numéricos.'
      ];

      $validator = Validator::make(request()->all(), $rules, $messages);

      // process the login
      if ($validator->fails()) {
        return redirect('produto/' . $id)
        ->withErrors($validator);
      } else {
        // store
        $product = Product::find($id);
        $product->stock -= request()->get('stock');
        $product->save();

        return redirect('produtos')->with('success','Estoque atualizado com sucesso!');
      }
    }
}

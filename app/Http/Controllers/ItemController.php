<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemsController extends Controller
{

    public function __construct(){
    $this->middleware('auth');
    }

    public function index()
    {
    }


    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
      $item = Item::findOrFail($id);
      return view('item.show', compact('item'));
    }

    public function showByClient($client_id)
    {
      $items = Item::where('client_id','=', $client_id)->get();
      return view('item.index', compact('items'));
    }

    public function edit($id)
    {
      $item = Item::findOrFail($id);
      return view('items.edit')->with('item', $product);
    }

    public function update($id)
    {

    }

    public function destroy($id)
    {

    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller{
    public function index(){
        return view("form");
    }
    public function show(Request $request){
        $request->validate([
            'bookName' => 'required',
            'bookDescription' => 'required',
            'stock' => 'required|integer',
            'price' => 'required|numeric|between:2.50,99.99',
            'image' => 'required|max:2048|mimes:jpg,jpeg,png'
        ],[
            'bookName.required' => 'Book Name cannot be empty!',
            'bookDescription.required' => 'Book Description cannot be empty!',
            'stock.required' => 'Stock cannot be empty!',
            'stock.integer' => 'Stock must be a number!',
            'price.required' => 'Price cannot be empty!',
            'price.numeric' => 'Price must be a number!',            'price.numeric' => 'Price must be a number!',
            'price.between' => 'Price must be between 2.50 and 99.99!',
            'image.required' => 'Image cannot be empty!',
            'image.mimes' => 'Image format must be JPEG, PNG, JPG!',
            'image.max' => 'The Image size should not exceed 2048 Kb!',
        ]);
        $request->image->storeAs('public/images', $request->image->getClientOriginalName());
        $result= [
            'bookName' => $request->bookName,
            'bookDescription' => $request->bookDescription,
            'stock' => $request->stock,
            'price' => $request->price,
            'image' => $request->image->getClientOriginalName(),
        ];
        return redirect('/result')->with(['result' => $result, 'status' => 'Form Submitted!']);
    }
    public function result(){
        $result = session()->get('result');
        return view('result', ['result' => $result]);
    }
}
// class Controller extends BaseController
// {
//     use AuthorizesRequests, ValidatesRequests;
// }

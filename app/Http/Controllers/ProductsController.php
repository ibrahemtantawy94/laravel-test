<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{

    public function index()
    {
        $fileToArray = json_decode(Storage::disk('local')->get('products.json'),true);
        $full_price = 0;

        foreach ($fileToArray as $value){
            $full_price+= $value['total_value'];
        }
        $data = [
            'products'=>$fileToArray,
            'full_price' =>$full_price
        ];
        return view('home')->with($data);

    }

    public function show(Request $request){

        $fileToArray = json_decode(Storage::disk('local')->get('products.json'),true);

        $input = $request->only(['product_name', 'quantity', 'price']);

        $input['date'] = date('Y-m-d H:i:s');
        $total_value = $input['quantity'] * $input['price'];
        $input['total_value'] = $total_value;

        array_push($fileToArray,$input);

        Storage::disk('local')->put('products.json', json_encode($fileToArray));
        $full_price = 0;

        foreach ($fileToArray as $value){
            $full_price+= $value['total_value'];
        }
        $data = [
            'products'=>$fileToArray,
            'full_price' =>$full_price
        ];
//        dd($fileToArray);
        return view('home')->with($data);
    }

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //validating the request
//        $this->validate($request,[
//            'product_name' =>'required|min:2|max:50',
//            'quantity' =>'required|numeric',
//            'price'=>'required|numeric',
//        ]);
//
//        $products = new Products();
//        $products->product_name = request('product_name');
//        $products->quantity = request('quantity');
//        $products->price = request('price');
//        $products->save();
//        return redirect('/')->with('success','Product added successfully'); //redirect to the view with a success message
//
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        $products = Products::find($id);
//        $data = ['$products'=>$products];
//        return view('/',$data);
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//    {
//        //validating the request
//        $this->validate($request,[
//            'product_name' =>'required|min:2|max:50',
//            'quantity' =>'required|numeric',
//            'price'=>'required|numeric',
//        ]);
//        $products = Products::find($id);
//        $products->product_name = request('product_name');
//        $products->quantity = request('quantity');
//        $products->price = request('price');
//        $products->save();
//        return redirect('/employees')->with('success','Product Edited successfully');
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        $product = Products::find($id);
//        $product->delete();
//        return redirect('/')->with('success','Product Deleted Successfully');
//    }

}

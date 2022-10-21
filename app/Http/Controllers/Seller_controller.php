<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Seller_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = Seller::paginate(50);
       return view('seller.sellers')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->id ==''){
        
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:100',
            'email' => 'required|email|unique:sellers',
            'status' => 'required',

        ]);

        if($validator->fails())
        {
            return response()->json([
                'validate_err'=> $validator->messages(),
                'status'=>422,
            ]);
        }
        else
        {

        $data = new Seller();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->status = $request->status;
        $data->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Seller Added Successfully',
        ]);

        }

    }else{


        $validator = Validator::make($request->all(),[
            'name' => 'required|max:100',
            'email' => 'required|email',
            'status' => 'required',

        ]);

        if($validator->fails())
        {
            return response()->json([
                'validate_err'=> $validator->messages(),
                'status'=>422,
            ]);
        }
        else
        {

        $data =  Seller::find($request->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->status = $request->status;
        $data->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Seller updated Successfully',
        ]);

        }



    }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data =  Product::where('seller_id',$id)->paginate(50);
        return view('product.products')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showseller($id)
    {
        
        $data = Seller::find($id);
        return response()->json([
            'status'=> 200,
            'data'=> $data,
        ]);
    }



}

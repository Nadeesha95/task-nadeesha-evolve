<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class Product_controller extends Controller
{
 

    public function show($id){


        $data = Product::find($id);
        return response()->json([
            'status'=> 200,
            'data'=> $data,
        ]);

    }


}

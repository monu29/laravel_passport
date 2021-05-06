<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Store;
use Validator;

class ItemController extends Controller
{
	public function index(Request $request)
    {
        $res=[];
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'color' => 'required',
            'store_id' => 'required',
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()]);
        }
        try{
            $item = $request->all();
           
            $item = Item::create($item);
            $res['status'] = 200;
            $res['message'] = "Item added successfully!";
          
            return response()->json(['response' =>$res]);
        } catch (Exception $e) {
            return response()->json(['error' => trans('api.something_went_wrong')]);
        }
    }
    public function getItems(Request $request)
    {
    	$items = Item::with('store')->get();
        if(count($items)>0){
       	    $res['status'] = 200;
            $res['message'] = "Records Found..";
            $res['data'] = $items;    
        }else{
       	    $res['status'] = 400;
            $res['message'] = "Records Not Found..";
        }
	    return response()->json(['response' =>$res]);
    }
}

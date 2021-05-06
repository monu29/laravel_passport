<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Validator;

class StoreController extends Controller
{
    public function index(Request $request)
    {
       if ($request->isMethod('post')) {
	        $validator = Validator::make($request->all(), [ 
	            'name' => 'required|unique:stores',
	        ]);
	        if ($validator->fails()) { 
	            return response()->json(['error'=>$validator->errors()]);
	        } 
            try{
	            $store = $request->all();
	            $store = Store::create($store);
	            $res['status'] = 200;
	            $res['message'] = "Record Added successfully!";
            } catch (Exception $e) {
            	return response()->json(['error' => trans('api.something_went_wrong')]);
            }
       }else{
	        $store= Store::All();
	        if(count($store)>0){
	       	    $res['status'] = 200;
	            $res['message'] = "Records Found..";
	            $res['data'] = $store;     
	        }else{
	       	    $res['status'] = 400;
	            $res['message'] = "Records Not Found..";
	        }
       }
        return response()->json(['response' => $res]);

    }
}

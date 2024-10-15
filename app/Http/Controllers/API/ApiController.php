<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Carbon\Carbon;

class ApiController extends Controller
{
    //
    public function getCategory(){
        $data = Category::get();

        return response()->json($data);
    }

    public function detailCategory($id){
        $data = Category::where('id',$id)->first();

        return response()->json($data);
    }

    public function createCategory(Request $request){
        $data = $this->getCategoryInfo($request);
        // return $data;
        $category = Category::create($data);

        return response()->json($category);
    }

    public function createContact(Request $request){
        $data = $this->getContactInfo($request);
        // return $data;
        $contact = Contact::create($data);

        return response()->json($contact);
    }

    public function updateCategory(Request $request,$id){
        $data = [
            'name'=>$request->categoryName,
            'updated_at'=>Carbon::now()
        ];
        // return $data;
        $category = Category::where('id',$id)->update($data);

        return response()->json($category);
    }

    public function deleteCategory($id){
        // return $data;
        $category = Category::where('id',$id)->delete();

        return response()->json(['message'=>'delete success'],200);
    }




    private function getCategoryInfo($request){
        return [
            'name'=>$request->categoryName,
            'created_at'=>Carbon::now()
        ];
    }

    private function getContactInfo($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'order_code' =>$request->orderCode,
            'created_at'=>Carbon::now()
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    public function list(){
        $products = Product::select('products.*','categories.name as category_name')
        ->when(request('search'),function($query){
            $query->where('name','like','%'.request('search').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')
        ->paginate(5);

        // dd($products->toArray());

        $products->appends(request()->all());
        return view('admin.product.list',compact('products'));
    }

    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    public function create(Request $request){
        $this->validation($request,'create');
        $data = $this->getInfo($request);


        if($request->hasFile('image')){
            $filename = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$filename);
            $data['image'] = $filename;
        }

        Product::create($data);
        return redirect()->route('product#list');
    }

    public function edit($id){
        $product = Product::where('id',$id)->first();
        $categories = Category::select('id','name')->get();
        return view('admin.product.edit',compact('product','categories'));
    }

    public function update(Request $request,$id){
        $product = Product::where('id',$id)->first();
        $this->validation($request,'update');
        $data = $this->getInfo($request);

        // For Image
        if($request->hasFile('image')){
            $product = Product::where('id',$id)->first();
            $dbImage = $product->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $filename = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$filename);
            $data['image'] = $filename;

        }
        Product::where('id',$id)->update($data);
        return redirect()->route('product#list')->with(['success'=>'update success']);
    }



    public function delete($id){
        $product = Product::where('id',$id)->first();
        $dbImage = $product->image;
        if($dbImage != null){
            Storage::delete('public/'.$dbImage);
            Product::where('id',$id)->delete();
        }

        return back();


    }

    public function detail($id){
        $product = Product::where('id',$id)->first();
        return view('admin.product.detail',compact('product'));
    }



    private function validation($request,$status){
        if($status == 'create'){
            Validator::make($request->all(), [
                'name' => 'required|unique:products,name',
                'description' => 'required',
                'category' => 'required',
                'price' => 'required',
                'time' => 'required',
                'image' => 'required|mimes:jpg,jpeg,png,webp|file',

            ])->validate();
        }else{
            Validator::make($request->all(), [
                'name' => 'required|unique:products,name,'.$request->productId,
                'description' => 'required',
                'category' => 'required',
                'price' => 'required',
                'time' => 'required',
                'image' => 'mimes:jpg,jpeg,png,webp|file',

            ])->validate();
        }
   }

   private function getInfo($request){
    return [
        'name'=>$request->name,
        'category_id'=>$request->category,
        'description'=>$request->description,
        'price'=>$request->price,
        'waiting_time'=>$request->time,
    ];
   }
}

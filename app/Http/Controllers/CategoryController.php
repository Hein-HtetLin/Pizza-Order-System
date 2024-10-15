<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
// use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function list(){
        $categories = Category::when(request('search'),function($query){
        $query->where('name','LIKE','%'.request("search").'%');})
        ->orderBy('created_at','desc')->paginate(5);

        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories') );
    }
    public function createPage(){
        return view('admin.category.create');
    }

    public function create(Request $request){
        // dd($request->all());
        $this->validation($request);
        Category::create([
            'name'=>$request->category
        ]);
        return redirect()->route('category#list')->with(['success'=>'created success']);
    }

    public function edit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request,$id){
        $this->validation($request);
        Category::where('id',$id)->update([
            'name'=>$request->category
        ]);
        return redirect()->route('category#list')->with(['success'=>'created success']);

    }

    public function delete($id){
        Category::where('id',$id)->delete();
        return redirect()->route('category#list')->with(['success'=>'created success']);
    }

    public function search(Request $request){
        $categories = Category::where('name','Like','%'.$request->search.'%')->get();
        return view('admin.category.list',compact('categories') );

    }


    private function validation($request){
         Validator::make($request->all(), [
            'category' => 'required| unique:categories,name,'.$request->categoryId,// 'password_confirmation' => ['required'],
        ])->validate();
    }
}

<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function home(){
        $order = Order::where('user_id',Auth::user()->id)->get();
        $cart = Cart::get();
        $products = Product::when(request('cate'),function($query){
            $query->where('category_id',request('cate'));
        })
        ->get();
        $categories = Category::get();

        return view('user.index',compact('products','categories','cart','order'));

    }

    public function productDetail($id){
        $product = Product::where('id',$id)->first();
        $products = Product::get();
        return view('user.detail',compact('product','products'));
    }

    public function profile(){
        return view('user.profile.profile');
    }

    public function changePage(){
        return view('user.profile.password');
    }

    public function changePwd(Request $request){

        $validator = Validator::make($request->all(),[
            'oldPwd' => 'required',
            'newPwd' => 'required | min:8',
            'confirmPwd' =>'required|same:newPwd|min:8'
        ]);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            };

            // dd($request->toArray());
            $user = User::where('id',Auth::user()->id)->first();
            $dbPassword = $user->password;
            $hashPassword = Hash::make($request->newPwd);

            $updatePassword = [
                'password' => $hashPassword,
                'updated_at' =>Carbon::now()
            ];
            if(hash::check($request->oldPwd,$dbPassword)){
                User::where("id",Auth::user()->id)->update($updatePassword);
                return redirect()->route('auth#login');
            }else{
                return back()->with(['fail'=>'old password do not match']);
            }
        }

    public function edit(){
        return view('user.profile.edit');
    }

    public function update(Request $request,$id){
        $this->validation($request);
        $data = $this->getInfo($request);

        // For Image
        if($request->hasFile('image')){
            $user = User::where('id',$id)->first();
            $dbImage = $user->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $filename = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$filename);
            $data['image'] = $filename;

        }
        User::where('id',$id)->update($data);
        return redirect()->route('user#profile');
    }




    private function getInfo($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'address' =>$request->address,
            'phone' =>$request->phone,
            'gender' =>$request->gender,
        ];
    }

    private function validation($request){
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            // 'email' => 'required| unique:users'.$request->email,
            'address' => ['required'],
            'phone' => ['required'],
            'gender' => ['required'],
            // 'password_confirmation' => ['required'],
        ])->validate();}
}

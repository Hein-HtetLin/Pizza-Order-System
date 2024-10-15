<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    public function login(){
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function auth(){

        if(Auth::user()->role == 'admin'){
            // dd('admin');
            return redirect()->route('category#list');
        }else{
            return redirect()->route('user#home');
            // dd('user');
        }

    }

    public function changePwdPage(){
        return view('admin.dashboard.pwdChange');
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

            dd($request->toArray());
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

    public function profile(){
        return view('admin.dashboard.profile');
    }

    public function editPage(){
        return view('admin.dashboard.edit');
    }

    public function edit(Request $request,$id){
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
        return redirect()->route('admin#profile');
    }
    public function list(){
        $admin = User::where('role','admin')->when(request('search'),function($query){
            $query->where('name','like','%'.request('search').'%');
        })->get();
        return view('admin.dashboard.list',compact('admin'));
    }
    public function userList(){
        $user = User::where('role','user')->when(request('search'),function($query){
            $query->where('name','like','%'.request('search').'%');
        })->get();
        return view('admin.dashboard.userList',compact('user'));
    }
    public function changeRole(Request $request){
        User::where('id',$request->userId)->update([
            'role'=>$request->role
        ]);

        return response()->json([
            'message'=>'role change success'
        ]);
    }

    public function mail(){
        $mails =Contact::when(request('search'),function($query){
            $query->where('name','like','%'.request('search').'%');
        })->paginate(5);
        return view('admin.dashboard.mail',compact('mails'));
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
            'gender' => ['required'],
            'phone' => ['required'],
            // 'password_confirmation' => ['required'],
        ])->validate();
    }
}

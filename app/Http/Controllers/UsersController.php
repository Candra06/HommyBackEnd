<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;

class UsersController extends Controller
{
    use AuthenticatesUsers;
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');   
    }

    public function submit(Request $request)
    {
        print_r($request->input());
        // if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // return view('auth.login');
        // } else {
        //     return view('dashboard.index', ['user' => Auth::user(), 'status' => 'success']);
        // }
    }

    public function register()
    {
        return view('auth.register');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function log(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['id'] =  $user->id_user;
            $success['name'] =  $user->name;
            $success['email'] =  $user->email;
            $success['level'] =  $user->id_level;
            $success['status'] =  $user->status;
            $success['token'] =  $user->createToken('nApp')->accessToken;
            return response()->json(['data' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function reg(Request $request)
    {

        $email_cek = User::where('email', $request->email)->count();
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            ]);

        if ($email_cek > 0) {
            return response()->json(['error' => 'Email sudah terdaftar!'], 401);
        } else {

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);            
            }
    
            $input = $request->all();
            $input['id_user'] = Str::random(8);
            $input['password'] = bcrypt($input['password']);
            $input['id_level'] = 1;
            $input['status'] = 1;
            $user = User::create($input);
            // $success['email'] =  $user->email;
            // $success['token'] =  $user->createToken('nApp')->accessToken;
    
            return response()->json(['message' => 'Berhasil mendaftar' ], $this->successStatus);
        }

    }

    public function reg_member(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'handphone' => 'required|max:15',
            ]);
            
        $email_cek = User::where('email', $request->email)->count();
        $hp_cek = User::where('handphone', $request->handphone)->count();

        if ($email_cek > 0) {
            return response()->json(['error' => 'Email sudah terdaftar!'], 401);
        } if ($hp_cek > 0) {
            return response()->json(['error' => 'No Handphone sudah terdaftar!'], 401);
        } else {
            $input = $request->all();
            $input['id_user'] = Str::random(8);
            $input['password'] = bcrypt($input['password']);
            $input['address'] = " ";
            $input['id_level'] = 3;
            $input['status'] = 1;
            $user = User::create($input);
            // $success['email'] =  $user->email;
            // $success['token'] =  $user->createToken('nApp')->accessToken;
    
            return response()->json(['message' => 'Berhasil Mendaftar!'], $this->successStatus);
        }

    }

    public function details()
    {
        $user = Auth::user();
        return response()->json([
            'id' => $user->id_user,
            'name' => $user->name,
            'email' => $user->email,
            'handphone' => $user->handphone,
            'address' => $user->address,
            'level' => $user->id_level,
            'status' => $user->status],
            $this->successStatus
        );
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([ 'message' => 'Successfully logged out' ]); 
    }

}

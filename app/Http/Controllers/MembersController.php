<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;

class MembersController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //with Eloquent
        $members = Member::where('id_level', '3')->get();
        return view('member.index', compact('members'));
        
        // return $members;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['status' => 'failed']);
        } else {
            return response()->json(['user' => Auth::user(), 'status' => 'success']);
        }
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'handphone' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all();
        $input['id_member'] = Str::random(8);
        $input['password'] = bcrypt($input['password']);
        $input['status'] = 1;
        $user = Member::create($input);
        $success['email'] =  $user->email;
        $success['token'] =  $user->createToken('nApp')->accessToken;

        return response()->json(['success'=> $success], $this->successStatus);
        
        // Member::create([
        //     'id_member' => Str::random(8),
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'handphone' => $request->handphone,
        //     'address' => $request->address,
        //     'status' => 1
        // ]);

        // return response()->json('Berhasil Register!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return view('member.show', compact('member'));
        // return view('member.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'handphone' => 'required|min:10|max:15',
            'address' => 'required',
        ]);

        Member::where('id', $member->id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'handphone' => $request->handphone,
                        'address' => $request->address,
                    ]);
        
        return redirect('/member')->with('status', 'Data Member Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }
}

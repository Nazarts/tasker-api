<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $editable_fields = ['name', 'email', 'password'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedUserData = $request->validate([
                'name' => ['required', 'string'],
                'email' => ['required', 'unique:users,email', 'string'],
                'password' => ['required', 'min:8', 'string'],
            ]);
            $validatedUserData['password'] = Hash::make($validatedUserData['password']);
            DB::table('users')->insert($validatedUserData);
            return response()->json(['status'=>'OK']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'errors' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::all()->get($id);
        return response()->json($user);
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
        $validatedUserData = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'unique:user,email', 'string'],
            'password' => ['required', 'min:8', 'unique:users,password', 'string'],
        ]);
        DB::table('users')->where('id', $id)->updateOrInsert($validatedUserData);
        return response()->json(['status'=>'OK']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return response()->json(['status'=>'OK']);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'password' => 'required|min:8',
            'nombre' => 'required',
            'permissions' => 'required'
        ]);
        if (isset($validated['errors']))
        {
            return $validated;
        }

        $user = new User();
        $user->id = $request->id;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->nombre = strtoupper($request->nombre);
        $user->save();

        $USER_PERMISSIONS = ["3" => "EDIT", "5" => "EDIT", "6" => "EDIT", "10" => "EDIT"];
        $ADMIN_PERMISSIONS = ["1" => "EDIT", "2" => "EDIT", "3" => "EDIT", "4" => "EDIT", "5" => "EDIT", "6" => "EDIT", "7" => "EDIT", "8" => "EDIT", "9" => "EDIT", "10" => "EDIT"];
        $PERMISSIONS = $request->permissions === "admin" ? $ADMIN_PERMISSIONS : $USER_PERMISSIONS;
        foreach ($PERMISSIONS as $key => $value) {
            $permission = new Permission();
            $permission->user = $user->id;
            $permission->menu = $key;
            $permission->permission = $value;
            $permission->save();
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('name', 'password')))
        {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $user = User::where('name', $request->name)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json(['message' => 'Hi '.$user->name, 'access_token' => $token, 'token_type' => 'Bearer', 'user' => $user,]);
    }

    public function logout()
    {
        Auth::user()->tokens->each(function($token, $key) {
            $token->delete();
        });

        return response()->json('Successfully logged out');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->nombre = strtoupper($request->nombre);
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
    }
}

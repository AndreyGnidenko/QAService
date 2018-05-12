<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Admin as Admin;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $admins = Admin::all();

        return view('adminAdmins')->with(['admins' => $admins]);
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
            'login' => 'required|unique:admins',
            'password' => 'required|string|min:5|confirmed'
        ]);

        if ($validator->fails()) {

            return redirect()->route('admins.create')->withErrors($validator);
        }

        $admin = new Admin;
        $admin->fill(['login' => $request->login, 'password' => Hash::make($request->password) ]);
        $admin->save();

        return redirect()->route('admins.index');
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
        $admins = Admin::all();

        $editedAdmin = Admin::find($id);

        return view('adminAdmins')->with(['admins' => $admins, 'editedAdmin' => $editedAdmin]);
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
        $admin = Admin::find($id);
        if (!(Hash::check($request->get('current-password'), $admin->password)))
        {
            return redirect()->route('admins.edit', $id)->withErrors("Your current password does not match the password you provided. Please try again.");
        }

        $validator = Validator::make($request->all(), [
            'current-password' => 'required',
            'new-password' => 'required|string|min:5|confirmed'
        ]);

        if ($validator->fails()) {

            return redirect()->route('admins.edit', $id)->withErrors($validator);
        }

        $admin->password = Hash::make($request->get('new-password'));
        $admin->save();

        return redirect()->route('admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::destroy($id);
        return redirect()->route('admins.index');
    }
}

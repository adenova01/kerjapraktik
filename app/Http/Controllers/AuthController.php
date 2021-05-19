<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Murid;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Auth.login');
    }

    public function cekLogin(Request $request)
    {
        $username = $request->post('username');
        $password = $request->post('pass');

        $admin = Admin::where('username', '=', $username, 'and', 'password', '=', $password)->first();
        
        if($admin){
            $data_session = [
                'nama' => $admin->nama_admin
            ];
            session($data_session);
            return redirect('Home');
        } else {
            $murid = Murid::where('nis','=',$username,'and','password','=',$password)->first();
            if($murid){
                $data_session = [
                    'nama' => $murid->nama_murid
                ];
                session($data_session);
                return redirect('HomeMurid');
            } else {
                echo "gagal";
                return redirect('/');
            }
        }
    }

    public function Logout(Request $request)
    {
        $request->session()->forget(['nama']);
        return redirect('/');
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
}

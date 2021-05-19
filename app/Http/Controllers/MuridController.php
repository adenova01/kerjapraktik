<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Murid;
use App\Models\Buku;

class MuridController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $murid = Murid::all();
        return view('admin.datamurid', compact('murid'));
    }

    public function home_page()
    {
        $buku = Buku::all();
        return view('Murid.home', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = "AddMurid";
        return view('admin.add-editMurid', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nis_db = Murid::count()+1;
        $nis = (date('y').''.$nis_db);
        $pass = Murid::get('password');
        $new_pass = rand(1, 10000);

        foreach($pass as $value){
            if($new_pass != $value->password){
                $new_pass_db = $new_pass;
                break;
            } else {
                $new_pass = rand(1, 10000);
            }
        }

        $data = [
            'nis' => $nis,
            'nama_murid' => $request->post('nama_murid'),
            'jenis_kelamin' => $request->post('jenkel'),
            'alamat' => $request->post('alamat'),
            'password' => $new_pass_db
        ];

        $insert = Murid::insert($data);

        if($insert){
            return redirect('AddMurid')->with('message','Murid Berhasil Di tambahkan');
        } else {
            return redirect('AddMurid')->with('message','Murid gagal Di tambahkan');
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
        $action = 'UpdateMurid/'.$id;
        $murid = Murid::where('NIS', $id)->first();
        return view('admin.add-editMurid', compact('murid','action'));
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
        $data_murid = Murid::where('nis', $id)->first();
        
        $data = [
            'nama_murid' => $request->post('nama_murid'),
            'jenis_kelamin' => $request->post('jenkel'),
            'alamat' => $request->post('alamat'),
            'password' => $data_murid->password
        ];

        $update = Murid::where('nis',$id)->update($data);

        if($update){
            return redirect('AddMurid')->with('message','Murid Berhasil Di ubah');
        } else {
            return redirect('AddMurid')->with('message','Murid gagal Di ubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Murid::where('nis', $id)->delete();
        if($delete){
            return redirect('DataMurid')->with('message', 'Data murid sukses di hapus');
        }
    }
}

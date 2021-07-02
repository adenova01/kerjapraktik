<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Murid;
use App\Models\Buku;
use App\Models\Peminjam;
use App\Models\Kategori;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\DB;
use \DateTime;

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
        return view('admin.page.datamurid', compact('murid'));
    }

    public function home_page($kode_kat = false)
    {
        if($kode_kat){
            $buku = Buku::where('kode_kategori', $kode_kat)->get();
        } else {
            $buku = Buku::all();
        }

        $kategori = Kategori::all();
        $jumlah_pinjam = Peminjam::where('nis', session('nis'))
            ->where('status','not like','dikembalikan')
            ->count();
        return view('Murid.home', compact('buku','jumlah_pinjam','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = "AddMurid";
        return view('admin.page.add-editMurid', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Murid::count() != 0){
            $nis_db = Murid::count()+1;
            $nis = (date('y').'000'.$nis_db);
        } else {
            $nis = (date('y').'000'.(Murid::count()+1));
        }

        $new_pass = rand(1000, 1000000);
        
        if(Murid::count() !=0 ){
            $pass = Murid::get('password');
            foreach($pass as $value){
                if($new_pass == $value->password){
                    $new_pass = rand(1000, 1000000);
                } else {
                    break;
                }
            }
        }

        $new_pass_db = (date('y')).''.$new_pass;

        $file = $request->file('foto_murid');
        $extension = $file->extension();
        $nama_murid = str_replace(' ', '_', $request->post('nama_murid'));
        $name_save = $nis.'_'.$nama_murid.'.'.$extension;
        $location = 'foto_murid';
        
        $upload = $file->move($location, $name_save);

        $data = [
            'nis' => $nis,
            'foto' => $name_save,
            'nama_murid' => $request->post('nama_murid'),
            'jenis_kelamin' => $request->post('jenkel'),
            'alamat' => $request->post('alamat'),
            'password' => $new_pass_db,
            'create_by' => session('id')
        ];

        $insert = Murid::insert($data);

        if($insert){
            return redirect('AddMurid')->with('message','Murid Sukses Di tambahkan');
        } else {
            return redirect('AddMurid')->with('message','Murid gagal Di tambahkan');
        }
    }

    public function detil_pinjaman()
    {
        $peminjam = Peminjam::where('nis', session('nis'))->get();
        $tgl_sekarang = new DateTime();
        
        foreach($peminjam as $i => $row){
            $data_buku[$i] = DB::table('buku')
                ->where('id_buku',$row->id_buku)->first();
            $tgl2 = new DateTime($row->tanggal_kembali);
            $tenggang_waktu[$i] = $tgl_sekarang->diff($tgl2)->days;
        }

        return view('murid.detil_pinjam', compact('data_buku','peminjam','tenggang_waktu'));
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
        return view('admin.page.add-editMurid', compact('murid','action'));
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Murid;
use App\Models\Buku;
use App\Models\Peminjam;

class PeminjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peminjam = DB::table('peminjam')
            ->join('buku','peminjam.id_buku','=','buku.id_buku')
            ->join('murid','peminjam.NIS','=','murid.NIS')
            ->get();
        return view('admin.page.datapeminjam', compact('peminjam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $murid = Murid::all();
        $buku = Buku::all();
        return view('admin.page.add-editPeminjam', compact('murid','buku'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'NIS' => $request->post('nis'),
            'tanggal_pinjam' => $request->post('tgl_pinjam'),
            'tanggal_kembali' => $request->post('tgl_kembali'),
            'status' => 'pending',
            'id_buku' => $request->post('buku')
        ];

        $insert = Peminjam::insert($data);

        if(session('id') != null){
            if($insert){
                return redirect('AddPeminjam')->with('message','Peminjam buku sukses di tambahkan');
            } else {
                return redirect('AddPeminjam')->with('message','Peminjam buku gagal di tambahkan');
            }
        }else {
            return redirect('DetilPinjam');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $murid = Murid::all();
        $buku = Buku::all();
        $peminjam = Peminjam::where('id_peminjam',$id)->first();
        return view('admin.page.add-editPeminjam', compact('murid','buku','peminjam'));
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
        $data = [
            'NIS' => $request->post('nis'),
            'tanggal_pinjam' => $request->post('tgl_pinjam'),
            'tanggal_kembali' => $request->post('tgl_kembali'),
            'status' => 'pending',
            'id_buku' => $request->post('buku')
        ];

        $update = Peminjam::where('id_peminjam',$id)->update($data);

        if($update){
            return redirect('AddPeminjam')->with('message','Peminjam buku sukses di ubah');
        } else {
            return redirect('AddPeminjam')->with('message','Peminjam buku gagal di ubah');
        }
    }

    public function update_status($id, $kembali = false)
    {
        if($kembali == false){
            $data = [
                'status' => 'sukses di pinjam'
            ];
        } else {
            $data = [
                'status' => 'dikembalikan'
            ];
        }

        $update = Peminjam::where('id_peminjam',$id)->update($data);

        if($update){
            return redirect()->back();
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
        $peminjam = Peminjam::where('id_peminjam',$id)->delete();

        if($peminjam){
            return redirect('DataPeminjam')->with('message','Data peminjam sukses di hapus');
        } else {
            return redirect('DataPeminjam')->with('message','Data peminjam gagal di hapus');
        }
    }
}

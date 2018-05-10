<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Kamar;
use App\Model\TransaksiKamar;
use App\Model\Berita;
use App\Model\Unit;

class DashboardCtrl extends Controller
{
    //
    public function index()
    {
    	$this->data['title'] = 'Dashboard';
    	$this->data['deskripsi_title'] = 'Selamat datang';
        ////////// ARDI ////////////////////
        $this->data['kamar_tersedia'] = Unit::where('status_flag','O')->count();
        ////////////////////////////////////////////////
    	
    	$this->data['kamar_terpakai'] = Kamar::where('status',1)->count();
    	$this->data['kamar_kotor'] = Kamar::where('status',2)->count();
    	$this->data['tamu'] = TransaksiKamar::where('status',1)->get();
    	$this->data['tamu_checkout'] = TransaksiKamar::where('tgl_checkout',date('Y-m-d H:i:s'))->get();
        $this->data['berita'] = Berita::orderBy('created_at','DESC')->paginate(3);
    	return view('backend.dashboard',$this->data);
    }
}

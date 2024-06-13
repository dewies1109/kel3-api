<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::latest()->paginate(5);
        return view('barang.list_barang', compact('barangs'));
    }
}

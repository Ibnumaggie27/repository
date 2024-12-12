<?php

namespace App\Http\Controllers;
use App\Models\DataGuru;
use App\Models\sk;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil semua data guru dari tabel data_guru
        $dataGurus = DataGuru::all();
        $dataSks = Sk::all();

        // Mengirimkan data ke view
        return view('admin.index', compact('dataGurus','dataSks'));
    }
}

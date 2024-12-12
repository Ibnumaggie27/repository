<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaTemplateExport;
use App\Exports\GuruTemplateExport;

class TemplateController extends Controller
{
    public function index()
    {
        return view('admin.template.index'); // Menampilkan halaman dengan link download
    }

    public function download($type)
    {
        if ($type == 'siswa') {
            return Excel::download(new SiswaTemplateExport, 'template_siswa.xlsx');
        } elseif ($type == 'guru') {
            return Excel::download(new GuruTemplateExport, 'template_guru.xlsx');
        } else {
            abort(404); // Jika type tidak valid
        }
    }
}


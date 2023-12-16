<?php

namespace App\Http\Controllers;

use App\Exports\LogsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Bitacora;
use App\Http\Requests\StoreBitacoraRequest;
use App\Http\Requests\UpdateBitacoraRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class BitacoraController extends Controller
{
  

    
    public function index()
    {
        $bitacoras = Bitacora::paginate(10);
        return view('bitacora.index', compact('bitacoras'));
    }

    
    
    public function edit($data)
    {
        if ($data == 'csv') {
            return Excel::download(new LogsExport, 'logs.csv');
        } else {
            return Excel::download(new LogsExport, 'logs.xlsx');
        }
    }

    
}
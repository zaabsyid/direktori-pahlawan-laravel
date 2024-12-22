<?php

namespace App\Http\Controllers;

use App\Models\Pahlawan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PahlawanController extends Controller
{
    // public function pahlawans()
    // {
    //     $pahlawans = Pahlawan::all();
    //     return view("pahlawans", ["pahlawans" => $pahlawans]);
    // }
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pahlawans = Pahlawan::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->get();

        return view('pahlawans', compact('pahlawans'));
    }

    public function exportPdf()
    {
        $pahlawans = Pahlawan::all();

        $pdf = PDF::loadView('pdf', compact('pahlawans'))
            ->setPaper('A4', 'potrait');

        return $pdf->download('direktori_pahlawan.pdf');
    }
}

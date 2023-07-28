<?php

namespace App\Http\Controllers;

use App\Models\Rab;
use App\Models\RabDetail;
use App\Models\Sppd;
use App\Models\SuratTugasDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_sppd = Sppd::query()->thisYear()->count();
        $total_biaya = Rab::query()->thisYear()->sum('total_rab');
        $sppd_ongoing = Rab::query()->whereDoesntHave('realisasi')->count();
        $total_pegawai = SuratTugasDetail::query()->whereHas('rab')->count();

        return view('dashboard',compact('total_sppd','total_biaya','sppd_ongoing','total_pegawai'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Carbon\Carbon;

class HistoryController extends Controller
{
    
      public function getAbsensiById( $userId){

        $absensis = Absensi::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
            // dd($absensis);

        return response()->json($absensis);

     }

     public function showHistoryPage()
    {
        return view('history.history');
    }

}


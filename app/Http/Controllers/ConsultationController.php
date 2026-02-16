<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function print(Consultation $consultation)
    {
        $pdf = Pdf::loadView('pdf.consultation', [
            'consultation' => $consultation
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('konsultasi-' . $consultation->id . '.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BusinessPartner;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BpExportController extends Controller
{
    public function __invoke(BusinessPartner $bp)
    {
        return Pdf::loadView('pdfexport.businesspartner', ['record' => $bp])
            ->setPaper('a4', 'landscape')
            ->setWarnings(false)
            ->download($bp->bp_number . '.pdf');
    }
}

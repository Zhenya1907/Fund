<?php

namespace App\Http\Controllers;

use App\Jobs\ImportPaymentsJob;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PaymentImportController extends Controller
{
    public function showForm(): View
    {
        return view('importPayments.form');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csvFile' => 'required|mimes:csv,txt|max:10240',
        ]);

        $csvFile = $request->file('csvFile');
        ImportPaymentsJob::dispatch($csvFile->storePubliclyAs('csv', 'import_' . time() . '.csv', 'public'));

        return redirect()->route('importPayments.form')->with('success', 'CSV file is being processed.');
    }
}

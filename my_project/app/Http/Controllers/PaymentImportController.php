<?php

namespace App\Http\Controllers;

use App\Jobs\ImportPaymentsJob;
use Illuminate\Http\Request;

class PaymentImportController extends Controller
{
    public function showForm(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('importPayments.form');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csvFile' => 'required|mimes:csv,txt|max:10240',
        ]);

        $csvFile = $request->file('csvFile');
        $csvFilePath = 'storage/app/public/' . $csvFile->storeAs('csv', 'import_' . time() . '.csv', 'public');
        ImportPaymentsJob::dispatch($csvFilePath);

        return redirect()->route('importPayments.form')->with('success', 'CSV file is being processed.');
    }
}

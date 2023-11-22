<?php

namespace App\Jobs;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ImportPaymentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $csvFilePath;

    public function __construct($csvFilePath)
    {
        $this->csvFilePath = $csvFilePath;
    }

    public function handle(): void
    {
        $csvData = array_map('str_getcsv', file(storage_path('app/public/' . $this->csvFilePath)));

        DB::transaction(function () use ($csvData) {
            array_shift($csvData);
            foreach ($csvData as $row) {
                $userId = $row[0] ? $row[0] : null;
                $amount = $row[1];
                Payment::create([
                    'user_id' => $userId,
                    'amount' => $amount,
                ]);
            }
        });

        Storage::delete($this->csvFilePath);
    }
}

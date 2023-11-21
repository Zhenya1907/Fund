<?php

namespace App\Jobs;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
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
        $csvData = array_map('str_getcsv', file($this->csvFilePath));

        foreach ($csvData as $row) {
            $userId = $row[0];
            $amount = $row[1];

            if (!empty($userId) && is_numeric($userId)) {
                Payment::create([
                    'user_id' => (int) $userId,
                    'amount' => $amount,
                ]);
            }
        }
        Storage::delete($this->csvFilePath);
    }
}

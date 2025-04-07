<?php

namespace App\Jobs;

use App\Models\AppUser;
use App\Models\Kredit;

use App\Notifications\ImportCompletedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportKreditJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $rows;
    public $datadate;
    public $headerMap;
    public $userId;

    /**
     * Create a new job instance.
     */
    public function __construct(array $rows, string $datadate, array $headerMap, int $userId)
    {
        $this->rows = $rows;
        $this->datadate = $datadate;
        $this->headerMap = $headerMap;
        $this->userId = $userId; // Menyimpan user_id yang dikirim dari controller
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        foreach ($this->rows as $row) {
            $rowData = [];
            foreach ($this->headerMap as $headerName => $dbColumn) {
                if (isset($row[$headerName])) {
                    $rowData[$dbColumn] = $row[$headerName];
                }
            }

            $rowData['datadate'] = $this->datadate;

            Kredit::create($rowData);
        }

        // Kirim notifikasi ke user yang aktif (dikirim dari controller)
        $user = AppUser::find($this->userId);
        if ($user) { 
            $user->notify(new ImportCompletedNotification('Proses impor data telah selesai.'));
        }
    }
}

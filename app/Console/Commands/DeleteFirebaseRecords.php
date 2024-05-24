<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Carbon\Carbon;

class DeleteFirebaseRecords extends Command
{
    protected $signature = 'firebase:delete-records';
    protected $description = 'Deletes records older than 2 hours from Firebase';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Menggunakan path relatif dari root proyek
        $path = base_path('tester-6b415-firebase-adminsdk-uzoft-17b227385e.json');
        $this->info("Service account path: $path");
        if (!is_readable($path)) {
            $this->error("The file at '$path' is not readable");
            return;
        }

        // Setel nama database yang benar
        $factory = (new Factory)
            ->withServiceAccount($path)
            ->withDatabaseUri('https://tester-6b415-default-rtdb.asia-southeast1.firebasedatabase.app');

        $database = $factory->createDatabase();
        $chatsRef = $database->getReference('chats');
        $onProgressRef = $database->getReference('onProgress');

        $twoHoursAgo = now()->setTimezone('Asia/Jakarta')->subHour(2);

        // Ambil semua ID dari onProgress
        $onProgressIds = $onProgressRef->getSnapshot()->getValue();

        // Pastikan $onProgressIds diinisialisasi sebagai array jika belum ada
        $onProgressIds = $onProgressIds ?? [];

        // Ambil semua chats
        $chats = $chatsRef->getSnapshot()->getValue();
        foreach ($chats as $subfolder => $records) {
            // Hanya proses subfolder yang tidak ada di onProgress
            if (!array_key_exists($subfolder, $onProgressIds)) {
                foreach ($records as $recordKey => $record) {
                    // Logging struktur data untuk debugging
                    $this->info("Subfolder: $subfolder");
                    $this->info("Record Key: $recordKey");
                    $this->info("Record: " . json_encode($record));

                    // Pastikan $record adalah array dan memiliki kunci 'msgs' dan 'timestamp'
                    if (is_array($record) && isset($record['msgs']['timestamp'])) {
                        $recordTimestamp = Carbon::createFromFormat('Y-m-d H:i:s', $record['msgs']['timestamp'], 'Asia/Jakarta');

                        $this->info("Current time minus two minutes: " . $twoHoursAgo->toDateTimeString());
                        $this->info("Record timestamp: " . $recordTimestamp->toDateTimeString());

                        if (!($recordTimestamp instanceof Carbon)) {
                            $this->error("Record timestamp is not a Carbon instance.");
                        }

                        if (!($twoHoursAgo instanceof Carbon)) {
                            $this->error("Current time minus two minutes is not a Carbon instance.");
                        }

                        if ($recordTimestamp->lessThan($twoHoursAgo)) {
                            $this->info("Condition is true, should delete.");
                            $chatsRef->getChild($subfolder)->remove();
                            $this->info("Deleted subfolder: " . $subfolder);
                            break; // Keluar dari loop setelah menghapus subfolder
                        } else {
                            $this->info("Condition is false, not deleting.");
                        }
                    } else {
                        $this->error("Invalid record structure in subfolder '$subfolder'");
                    }
                }
            }
        }

        $this->info('Old records have been deleted successfully.');
    }
}

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

        $twoHoursAgo = now()->subHours(2);

        // Ambil semua ID dari onProgress
        $onProgressIds = $onProgressRef->getSnapshot()->getValue();

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
                        $recordTimestamp = Carbon::createFromFormat('Y-m-d H:i:s', $record['msgs']['timestamp']);
                        if ($recordTimestamp->lessThan($twoHoursAgo)) {
                            // Menghapus seluruh subfolder jika item terakhir lebih tua dari dua jam
                            $chatsRef->getChild($subfolder)->remove();
                            break; // Keluar dari loop setelah menghapus subfolder
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

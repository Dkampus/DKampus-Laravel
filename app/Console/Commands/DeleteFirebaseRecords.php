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
        $path = base_path('tester-6b415-firebase-adminsdk-uzoft-17b227385e.json');
        $this->info("Service account path: $path");
        if (!is_readable($path)) {
            $this->error("The file at '$path' is not readable");
            return;
        }

        $factory = (new Factory)
            ->withServiceAccount($path)
            ->withDatabaseUri('https://tester-6b415-default-rtdb.asia-southeast1.firebasedatabase.app');

        $database = $factory->createDatabase();
        $chatsRef = $database->getReference('chats');
        $onProgressRef = $database->getReference('onProgress');

        $twoHoursAgo = now()->setTimezone('Asia/Jakarta')->subHour(2);

        $onProgressIds = $onProgressRef->getSnapshot()->getValue();

        $onProgressIds = $onProgressIds ?? [];

        $chats = $chatsRef->getSnapshot()->getValue();
        foreach ($chats as $subfolder => $records) {
            if (!array_key_exists($subfolder, $onProgressIds)) {
                foreach ($records as $recordKey => $record) {
                    if (is_array($record) && isset($record['msgs']['timestamp'])) {
                        $recordTimestamp = Carbon::createFromFormat('Y-m-d H:i:s', $record['msgs']['timestamp'], 'Asia/Jakarta');

                        if ($recordTimestamp->lessThan($twoHoursAgo)) {
                            $chatsRef->getChild($subfolder)->remove();
                            $this->info('Old records have been deleted successfully.');
                            break;
                        }
                    } else {
                        $this->error("Invalid record structure in subfolder '$subfolder'");
                    }
                }
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\StatusRequest;
use Illuminate\Database\Seeder;

class StatusRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define sample data
        $data = [
            ['request_status' => 'Pending'],
            ['request_status' => 'Accepted'],
            ['request_status' => 'Canceled'],
        ];

        // Insert data using Eloquent model
        foreach ($data as $row) {
            $existingRecord = StatusRequest::where('request_status', $row['request_status'])->first();

            if (!$existingRecord) {
                StatusRequest::create($row);
            }
        }
    }
}

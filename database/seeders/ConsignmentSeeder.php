<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consignment;

class ConsignmentSeeder extends Seeder
{
    public function run()
    {
        $sampleData = [
            [
                'company' => 'ABC Company',
                'contact' => 'John Doe',
                'addressline1' => '123 Main St',
                'addressline2' => 'Suite 456',
                'addressline3' => 'Building C',
                'city' => 'Cityville',
                'country' => 'Countryland',
            ],
            [
                'company' => 'XYZ Corporation',
                'contact' => 'Jane Smith',
                'addressline1' => '789 Elm Ave',
                'addressline2' => 'Floor 10',
                'addressline3' => 'Tower 2',
                'city' => 'Townsville',
                'country' => 'Otherland',
            ],
            // Add more sample data entries as needed
        ];

        foreach ($sampleData as $data) {
            Consignment::create($data);
        }
    }
}

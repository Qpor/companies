<?php

namespace App\Services\Import;

use App\Models\Company;
use Illuminate\Support\Facades\Log;

class CompanyImportService
{
    public function process(string $relativeFilePath): void
    {
        if (!file_exists($relativeFilePath)) {
            Log::error('The given file (' . $relativeFilePath . ') not found.');
            exit;
        }

        $row = 1;
        $headers = [];

        if (($handle = fopen($relativeFilePath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $refinedData = [];

                if ($row === 1) {
                    $headers = $data;
                    $row++;
                    continue;
                }

                foreach ($headers as $key => $header) {
                    $fieldName = $header;

                    $refinedData[$fieldName] = $data[$key];
                }

                Company::insert($this->transformCSVRowToModel($data));

                $row++;
            }

            fclose($handle);
        }
    }

    private function transformCSVRowToModel(array $data): array
    {
        $date = \DateTime::createFromFormat('Y.m.d', $data['companyFoundationDate']);

        return [
            'company_id' => (int)$data['companyId'],
            'company_name' => $data['companyName'],
            'company_registration_number' => (function($value){ return (int)str_replace('-', '', $value);})($data['companyRegistrationNumber']),
            'company_foundation_date' => $date,
            'country' => $data['country'],
            'zip_code' => (int)$data['zipCode'],
            'city' => $data['city'],
            'street_address' => $data['streetAddress'],
            'latitude' => (float)$data['latitude'],
            'longitude' => (float)$data['longitude'],
            'company_owner' => $data['companyOwner'],
            'employees' => (int)$data['employees'],
            'activity' => $data['activity'],
            'active' => (bool)$data['active'],
            'email' => $data['email'],
            'password' => $data['password']
        ];
    }
}

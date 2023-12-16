<?php

namespace App\Models;

class WorkerModel extends BaseModel
{
    public function addClient($data)
    {
        $columns = ['AddressId', 'Firstname', 'Lastname', 'NIP', 'Code', 'Type'];

        return $this->database->insertRecords("Client", $columns, $data);
    }

    public function addCar($data)
    {
        $columns = ['ClientId', 'WorkerId', 'Brand', 'Model', 'IdentificationNumber', 'Color', 'Mileage', 'EngineCapacity', 'Type', 'Status', 'AdmissionDate', 'SubmissionDate'];

        return $this->database->insertRecords("Car", $columns, $data);
    }

    public function addAddress($data)
    {
        $columns = ['City', 'Street', 'PostCode', 'HouseNumber', 'Phone', 'Email'];

        return $this->database->insertRecords("Address", $columns, $data);
    }
}
<?php

namespace App\Models;

class WorkerModel extends BaseModel
{
    public function addClient($data)
    {
        return $this->addRecord("Client", $data);
    }

    public function addCar($data)
    {
        return $this->addRecord("Car", $data);
    }

    public function addAddress($data)
    {
        return $this->addRecord("Address", $data);
    }

    public function updateClient($data, $id)
    {
        return $this->updateRecords("Client", $data, "Id = {$id}");
    }

    public function updateAddress($data, $id)
    {
        return $this->updateRecords("Address", $data, "Id = {$id}");
    }

    public function updateCar($data, $id)
    {
        return $this->updateRecords("Car", $data, "Id = {$id}");
    }
}

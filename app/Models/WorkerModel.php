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
}

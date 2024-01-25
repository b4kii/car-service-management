<?php

namespace App\Models;

class ServiceModel extends BaseModel
{
    public function addService($data)
    {
        return $this->addRecord("Service", $data);
    }

    public function updateService($data, $id)
    {
        return $this->updateRecords("Service", $data, "Id = {$id}");
    }
}
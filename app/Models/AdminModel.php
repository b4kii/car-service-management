<?php

namespace App\Models;

class AdminModel extends BaseModel
{
    public function addWorker($data)
    {
        return $this->addRecord("User", $data);
    }

    public function updateWorker($data, $id)
    {
        return $this->updateRecords("User", $data, "Id = {$id}");
    }
}

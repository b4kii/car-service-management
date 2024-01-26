<?php

namespace App\Models;

use App\Core\Commons\Formatter;

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
    
    public function carListDetails($workerId)
    {
        $workerCars = $this->getByCondition("Car", "WorkerId = {$workerId}");
        
        foreach ($workerCars as &$car) {
            $car["services"] = $this->getCarServiceDetails($car["Id"]);
            $car["client"] = $this->getClientDetails($car["ClientId"]);
            
            $car["AdmissionDate"] = Formatter::formatDate($car["AdmissionDate"]);
            $car["SubmissionDate"] = Formatter::formatDate($car["SubmissionDate"]);
        }
        
        return $workerCars;
    }
    
    public function getCarServiceDetails($carId)
    {
        return $this->getByCondition("Service", "CarId = {$carId}");
    }
    
    public function getClientDetails($clientId)
    {
        $query = "
            SELECT
                c.Id AS ClientId,
                c.AddressId,
                c.Firstname,
                c.Lastname,
                c.NIP,
                c.Type,
                a.City,
                a.Street,
                a.PostCode,
                a.HouseNumber,
                a.Phone,
                a.Email
            FROM Client c
            INNER JOIN Address a ON c.AddressId = a.Id
            WHERE c.Id='{$clientId}'
            ";
        
        $clientDetails = $this->database->query($query)->find();
        
        $clientDetails["Type"] = Formatter::mapClientType($clientDetails["Type"]);
        
        return $clientDetails;
    }
    
    public function getWorkerDetails($workerId)
    {
        $workerDetails = $this->getById("User", $workerId);
        
        $workerDetails["Role"] = Formatter::mapRole($workerDetails["Role"]);
        
        return $workerDetails;
    }
    
    public function updateWorker($data, $workerId)
    {
        return $this->updateRecords("User", $data, "Id={$workerId}");
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

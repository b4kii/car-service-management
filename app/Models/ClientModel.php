<?php

namespace App\Models;

class ClientModel extends BaseModel
{
    public function verifyCode($code): bool
    {
        return !!$this->getOneByCondition("Client", "Code='$code'");
    }
    
    public function getClientServiceDetails($code)
    {
        $details = $this->getClientCars($code);
        foreach ($details as &$car) {
            $car["services"] = $this->getClientCarDetails($car["Id"]);
        }
        return $details;
    }
    
    public function getClientDetails($code)
    {
        $query = "
            SELECT
                Id AS ClientId,
                AddressId,
                Firstname,
                Lastname,
                NIP,
                Type
            FROM Client
            WHERE Code='{$code}'
            ";
        
        return $this->database->query($query)->find();
    }
    
    public function getClientCars($code)
    {
        $query = "
            SELECT
                ca.Id,
                ca.Brand,
                ca.Model,
                ca.Status,
                ca.Color,
                ca.Type,
                ca.AdmissionDate,
                ca.SubmissionDate
            FROM Car ca
            WHERE ca.ClientId = (
                SELECT Id FROM Client WHERE Code = '{$code}'
            )
            ";
        
        return $this->database->query($query)->findAll();
    }
    
    public function getClientCarDetails($carId)
    {
        $query = "
            SELECT
                Name,
                Cost,
                Comment
            FROM Service
            WHERE CarId={$carId}
            ";
        
        return $this->database->query($query)->findAll();
    }
}







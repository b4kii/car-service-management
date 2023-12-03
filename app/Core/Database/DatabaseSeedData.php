<?php

namespace App\Core\Database;

class DatabaseSeedData
{
    public function __construct(private DatabaseConnection $databaseConnection)
    {
    }

    public function seedData() : void
    {
        $pdo = $this->databaseConnection->connection;
        try
        {
            $this->seedAddressData($pdo);
            $this->seedUserData($pdo);
            $this->seedClientData($pdo);
            $this->seedCarData($pdo);
            $this->seedServiceData($pdo);
        }catch(\Exception $exception) {
            echo "Error during adding seed data to database: " . $exception->getMessage();
            exit();
        };
    }

    public function seedAddressData($pdo) : void
    {
        $addressSeedData = [
            ['City' => 'Warszawa', 'Street' => 'Kwiatowa 1', 'PostCode' => '42-123', 'HouseNumber' => '23A', 'Phone' => '443-112-445', 'Email' => 'email1@mail.com'],
            ['City' => 'Warszawa', 'Street' => 'Lesna 43', 'PostCode' => '54-231', 'HouseNumber' => '2A', 'Phone' => '865-123-555', 'Email' => 'email2@mail.com'],
            ['City' => 'Krakow', 'Street' => 'Krakowska 12', 'PostCode' => '78-111', 'HouseNumber' => '93/2', 'Phone' => '846-900-321', 'Email' => 'email3@mail.com'],
            ['City' => 'Poznan', 'Street' => 'Cieszynka 49', 'PostCode' => '994-11', 'HouseNumber' => '4', 'Phone' => '884-338-000', 'Email' => 'email4@mail.com'],
            ['City' => 'Lublin', 'Street' => 'Krakowska 59', 'PostCode' => '78-001', 'HouseNumber' => '19C', 'Phone' => '846-900-321', 'Email' => 'email5@mail.com'],
            ['City' => 'Wroclaw', 'Street' => 'Wroclawska 153', 'PostCode' => '64-223', 'HouseNumber' => '331', 'Phone' => '833-000-001', 'Email' => 'email6@mail.com']
        ];
        $sql = $pdo->prepare('INSERT INTO Address (City, Street, PostCode, HouseNumber, Phone, Email) VALUES (:City, :Street, :PostCode, :HouseNumber, :Phone, :Email)');

        foreach ($addressSeedData as $data)
        {
            $sql->execute($data);
        }
    }

    public function seedUserData($pdo) : void
    {
        $userSeedData = [
            ['Login' => 'admin', 'Password' => 'admin123', 'Email' => 'admin@mail.com', 'Phone' => '993-213-421', 'Role' => 'Admin'],
            ['Login' => 'manager', 'Password' => 'manager123', 'Email' => 'manager@mail.com', 'Phone' => '993-213-114', 'Role' => 'Manager'],
            ['Login' => 'worker', 'Password' => 'worker123', 'Email' => 'worker@mail.com', 'Phone' => '778-220-410', 'Role' => 'Worker']
        ];
        $sql = $pdo->prepare('INSERT INTO User (Login, Password, Email, Phone, Role) VALUES (:Login, :Password, :Email, :Phone, :Role)');

        foreach ($userSeedData as $data)
        {
            $sql->execute($data);
        }
    }

    public function seedClientData($pdo) : void
    {
        $clientSeedData = [
            ['AddressId' => 1, 'Firstname' => 'Jan', 'Lastname' => 'Kowalski', 'NIP' => null, 'Code' => '0fd3e775-0abb-4ada-8006-234d45ad656e', 'Type' => 'Individual'],
            ['AddressId' => 2, 'Firstname' => 'Adam', 'Lastname' => 'Krawczyk', 'NIP' => '9874039213', 'Code' => '8fdbe043-74cc-4503-8055-3a1eeb917524', 'Type' => 'Company'],
            ['AddressId' => 3, 'Firstname' => 'Zenek', 'Lastname' => 'Kociol', 'NIP' => '8454320194', 'Code' => '86f5ec24-0ef4-4896-8cb2-887f06b0b2e5', 'Type' => 'Company'],
            ['AddressId' => 4, 'Firstname' => 'Dawid', 'Lastname' => 'Szybki', 'NIP' => null, 'Code' => '86f5ec24-0ef4-4896-8cb2-887f06b0b2e5', 'Type' => 'Individual'],
            ['AddressId' => 5, 'Firstname' => 'Karol', 'Lastname' => 'Lis', 'NIP' => null, 'Code' => 'c6f46a75-b386-4f01-bd66-4af33ebf4680', 'Type' => 'Individual'],
            ['AddressId' => 6, 'Firstname' => 'Daniel', 'Lastname' => 'Kot', 'NIP' => '8479283014', 'Code' => '512a64d1-9553-47eb-84ac-36bf42eb8e87', 'Type' => 'Company'],
        ];
        $sql = $pdo->prepare('INSERT INTO Client (AddressId, Firstname, Lastname, NIP, Code, Type) VALUES (:AddressId, :Firstname, :Lastname, :NIP, :Code, :Type)');

        foreach ($clientSeedData as $data)
        {
            $sql->execute($data);
        }
    }

    public function seedCarData($pdo) : void
    {
        $carSeedData = [
            ['ClientId' => 1, 'WorkerId' => 3, 'Brand' => 'Audi', 'Model' => 'A4', 'IdentificationNumber' => 'WAUKD78P29A034484', 'Color' => 'Red', 'Mileage' => 432454.234, 'EngineCapacity' => 1999.99, 'Type' => 'Sedan', 'Status' => 'New', 'AdmissionDate' => '2023-12-01 14:30:00', 'SubmissionDate' => null],
            ['ClientId' => 2, 'WorkerId' => 3, 'Brand' => 'Citroen', 'Model' => '206', 'IdentificationNumber' => 'WAUJC68E53A021100', 'Color' => 'Green', 'Mileage' => 890922.00, 'EngineCapacity' => 2499.99, 'Type' => 'Hatchback', 'Status' => 'InProgress', 'AdmissionDate' => '2023-02-11 19:30:00', 'SubmissionDate' => null],
            ['ClientId' => 3, 'WorkerId' => 3, 'Brand' => 'BMW', 'Model' => 'e46', 'IdentificationNumber' => 'WAUDG74FX5NO76837', 'Color' => 'Yellow', 'Mileage' => 9904992.00, 'EngineCapacity' => 2799.99, 'Type' => 'Coupe', 'Status' => 'New', 'AdmissionDate' => '2023-07-23 10:55:00', 'SubmissionDate' => '2023-11-10 10:55:00'],
            ['ClientId' => 4, 'WorkerId' => 3, 'Brand' => 'BMW', 'Model' => 'X3', 'IdentificationNumber' => 'WAUAF78E08A022739', 'Color' => 'Pink', 'Mileage' => 111132.233, 'EngineCapacity' => 3400.00, 'Type' => 'SUV', 'Status' => 'Cancelled', 'AdmissionDate' => '2022-10-23 10:55:00', 'SubmissionDate' => null],
        ];
        $sql = $pdo->prepare('INSERT INTO Car (ClientId, WorkerId, Brand, Model, IdentificationNumber, Color, Mileage, EngineCapacity, Type, Status, AdmissionDate, SubmissionDate) VALUES (:ClientId, :WorkerId, :Brand, :Model, :IdentificationNumber, :Color, :Mileage, :EngineCapacity, :Type, :Status, :AdmissionDate, :SubmissionDate)');

        foreach ($carSeedData as $data)
        {
            $sql->execute($data);
        }
    }

    public function seedServiceData($pdo) : void
    {
        $serviceSeedData = [
            ['CarId' => 1, 'Name' => 'Wymiana klocków przód', 'Cost' => 150.00, 'Comment' => null],
            ['CarId' => 1, 'Name' => 'Zmiana opon', 'Cost' => 250.00, 'Comment' => 'Problem przy odkręceniu tylnego, lewego koła'],
            ['CarId' => 3, 'Name' => 'Wymiana wycieraczek', 'Cost' => 50.00, 'Comment' => null],
            ['CarId' => 3, 'Name' => 'Mycie', 'Cost' => 350.00, 'Comment' => 'Auto zostało umyte wewnątrz oraz z zewnątrz'],
            ['CarId' => 3, 'Name' => 'Ładowanie akumulatora', 'Cost' => 0.00, 'Comment' => 'Samochód nie chciał odpalić po dłużej przerwie'],
            ['CarId' => 3, 'Name' => 'Wymiana poduszek silnika', 'Cost' => 200.00, 'Comment' => 'Wyciek oleju ze skrzyni biegów- do sprawdzenia'],
        ];
        $sql = $pdo->prepare('INSERT INTO Service (CarId, Name, Cost, Comment) VALUES (:CarId, :Name, :Cost, :Comment)');

        foreach ($serviceSeedData as $data)
        {
            $sql->execute($data);
        }
    }
}
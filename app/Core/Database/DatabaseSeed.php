<?php

namespace App\Core\Database;


use App\Core\Database\Interfaces\DatabaseInterface;

class DatabaseSeed {
    public function __construct(private DatabaseInterface $database)
    {
    }

    public function seedData() : void
    {
        try
        {
            $this->createTables();
            if ($this->database->isEmpty("Address")) {
                $this->seedAddressData();
                $this->seedUserData();
                $this->seedClientData();
                $this->seedCarData();
                $this->seedServiceData();
            }
        }catch(\Exception $exception) {
            echo "Error during adding seed data to database or database:
                {$exception->getMessage()}, line: {$exception->getLine()}, file: {$exception->getFile()}";
            exit();
        }
    }

    private function createTables()
    {
        $dbFile = file_get_contents(__DIR__ . '/Commons/car-service-management.sql');
        $this->database->query($dbFile);
    }

    private function seedAddressData() : void
    {
        $columns = ['City', 'Street', 'PostCode', 'HouseNumber', 'Phone', 'Email'];
        $data = [
            ['Warszawa', 'Kwiatowa 1', '42-123', '23A', '443-112-445', 'email1@mail.com'],
            ['Warszawa', 'Lesna 43', '54-231', '2A', '865-123-555', 'email2@mail.com'],
            ['Krakow', 'Krakowska 12', '78-111', '93/2', '846-900-321', 'email3@mail.com'],
            ['Poznan', 'Cieszynka 49', '994-11', '4', '884-338-000', 'email4@mail.com'],
            ['Lublin', 'Krakowska 59', '78-001', '19C', '846-900-321', 'email5@mail.com'],
            ['Wroclaw', 'Wroclawska 153', '64-223', '331', '833-000-001', 'email6@mail.com']
        ];

        $this->database->insertRecords('Address', $columns, $data);
    }

    private function seedUserData() : void
    {
        $columns = ['Login', 'Password', 'Email', 'Phone', 'Role'];
        $data = [
            ['admin', '$2y$10$ck3UCmkxN26r4XxVRwmZT.aR/8u6aTLwBq6soBnZYaUkPRwjCbuyC', 'admin@mail.com', '993-213-421', 'Admin'],
            ['manager', '$2y$10$jRxoGp2eT.pf08m7aNRl/OE2b581Cb5jc/l1Shnwx8WVjJkPDqQxq', 'manager@mail.com', '993-213-114', 'Manager'],
            ['worker', '$2y$10$2Rakb6E6Blp/.Jer52r5e.N5b7xbbtYzeKcfnHNup39LcchpnCNN.', 'worker@mail.com', '778-220-410', 'Worker']
        ];
        
        $this->database->insertRecords('User', $columns, $data);
    }

    private function seedClientData() : void
    {
        $columns = ['AddressId', 'Firstname', 'Lastname', 'NIP', 'Code', 'Type'];
        $data = [
            [1, 'Jan', 'Kowalski', null, '0fd3e775-0abb-4ada-8006-234d45ad656e', 'Individual'],
            [2, 'Adam', 'Krawczyk', '9874039213', '8fdbe043-74cc-4503-8055-3a1eeb917524', 'Company'],
            [3, 'Zenek', 'Kociol', '8454320194', '86f5ec24-0ef4-4896-8cb2-887f06b0b2e5', 'Company'],
            [4, 'Dawid', 'Szybki', null, '86f5ec24-0ef4-4896-8cb2-887f06b0b2e5', 'Individual'],
            [5, 'Karol', 'Lis', null, 'c6f46a75-b386-4f01-bd66-4af33ebf4680', 'Individual'],
            [6, 'Daniel', 'Kot', '8479283014', '512a64d1-9553-47eb-84ac-36bf42eb8e87', 'Company'],
        ];

        $this->database->insertRecords('Client', $columns, $data);
    }

    private function seedCarData() : void
    {
        $columns = ['ClientId', 'WorkerId', 'Brand', 'Model', 'IdentificationNumber', 'Color', 'Mileage', 'EngineCapacity', 'Type', 'Status', 'AdmissionDate', 'SubmissionDate'];
        $data = [
            [1, 3, 'Audi', 'A4', 'WAUKD78P29A034484', 'Red', 432454.34, 1999.99, 'Sedan', 'New', '2023-12-01 14:30:00', null],
            [2, 3, 'Citroen', '206', 'WAUJC68E53A021100', 'Green', 890922.00, 2499.99, 'Hatchback', 'InProgress', '2023-02-11 19:30:00', null],
            [3, 3, 'BMW', 'e46', 'WAUDG74FX5NO76837', 'Yellow', 9904992.00, 2799.99, 'Coupe', 'New', '2023-07-23 10:55:00', '2023-11-10 10:55:00'],
            [4, 3, 'BMW', 'X3', 'WAUAF78E08A022739', 'Pink', 111132.33, 3400.00, 'SUV', 'Cancelled', '2022-10-23 10:55:00', null],
        ];

        $this->database->insertRecords('Car', $columns, $data);
    }

    private function seedServiceData() : void
    {
        $columns = ['CarId', 'Name', 'Cost', 'Comment'];
        $data = [
            [1, 'Wymiana klocków przód', 150.00, null],
            [1, 'Zmiana opon', 250.00, 'Problem przy odkręceniu tylnego, lewego koła'],
            [3, 'Wymiana wycieraczek', 50.00, null],
            [3, 'Mycie', 350.00, 'Auto zostało umyte wewnątrz oraz z zewnątrz'],
            [3, 'Ładowanie akumulatora', 0.00, 'Samochód nie chciał odpalić po dłużej przerwie'],
            [3, 'Wymiana poduszek silnika', 200.00, 'Wyciek oleju ze skrzyni biegów- do sprawdzenia'],
        ];

        $this->database->insertRecords('Service', $columns, $data);
    }
}

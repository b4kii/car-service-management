<?php

namespace App\Controllers;

use App\Core\Commons\Session;
use App\Core\Twig\Twig;
use App\Enums\CarStatus;
use App\Models\WorkerModel;
use DateTime;
use Ramsey\Uuid\Uuid;
use Valitron\Validator;

class WorkerController
{
    public function __construct(public readonly WorkerModel $model, public readonly Twig $twig)
    {
    }

    public function addClientIndex()
    {
        return $this->twig->render('worker/create/add-client.html.twig');
    }

    public function addCarIndex()
    {
        $clients = $this->model->getAll("Client");

        return $this->twig->render('worker/create/add-car.html.twig', [
            "clients" => $clients
        ]);
    }

    public function addClient()
    {
        $validator = new Validator($_POST);
        $validator->rules([
            "required" => [
                ["firstname"],
                ["lastname"],
                ["city"],
                ["street"],
                ["phone"],
                ["email"],
            ],
            "lengthBetween" => [
                ["firstname", 1, 50],
                ["lastname", 1, 50],
                ["NIP", 1, 15],
                ["city", 1, 20],
                ["street", 1, 20],
                ["phone", 1, 15],
            ],
            "email" => [
                ["email"]
            ]
        ]);

        // client basic data
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $nip = $_POST["NIP"];
        $type = $_POST["type"];
        $code = (explode("-", Uuid::uuid4())[0]) . "$firstname[0]$lastname[0]";

        // client address data
        $city = $_POST["city"];
        $street = $_POST["street"];
        $postCode = $_POST["postCode"];
        $houseNumber = $_POST["houseNumber"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];

        if (!$validator->validate())
        {
            Session::flash("errors", [
                "firstname" => $validator->errors("firstname"),
                "lastname" => $validator->errors("lastname"),
                "city" => $validator->errors("city"),
                "street" => $validator->errors("street"),
                "phone" => $validator->errors("phone"),
                "email" => $validator->errors("email"),
            ]);

            redirect("/add-client");
        }

        $addressData = [
            'City' => $city,
            'Street' => $street,
            'PostCode' => $postCode,
            'HouseNumber' => $houseNumber,
            'Phone' => $phone,
            'Email' => $email
        ];
        $addressId = $this->model->addAddress($addressData);

        $clientData = [
            'AddressId' => $addressId,
            'Firstname' => $firstname,
            'Lastname' => $lastname,
            'NIP' => $nip,
            'Code' => $code,
            'Type' => $type
        ];
        $this->model->addClient($clientData);
    }

    public function addCar()
    {
        // dodać workerId z sesji
        $validator = new Validator($_POST);
        $validator->rules([
            "required" => [
                ["model"],
                ["identificationNumber"],
                ["color"],
                ["mileage"],
                ["engineCapacity"],
                ["submissionDate"],
            ],
            "lengthBetween" => [
                ["model", 1, 20],
                ["identificationNumber", 1, 15],
                ["color", 1, 15],
                ["mileage", 1, 20],
                ["engineCapacity", 1, 20],
            ],
        ]);

        $brand = $_POST["brand"];
        $model = $_POST["model"];
        $identificationNumber = $_POST["identificationNumber"];
        $clientId = $_POST["clientId"];
        $type = $_POST["type"];
        $color = $_POST["color"];
        $mileage = $_POST["mileage"];
        $engineCapacity = $_POST["engineCapacity"];
        $submissionDate = $_POST["submissionDate"];

        if (!$validator->validate())
        {
            Session::flash("errors", [
                "brand" => $validator->errors("brand"),
                "model" => $validator->errors("model"),
                "identificationNumber" => $validator->errors("identificationNumber"),
                "clientId" => $validator->errors("clientId"),
                "type" => $validator->errors("type"),
                "color" => $validator->errors("color"),
                "mileage" => $validator->errors("mileage"),
                "engineCapacity" => $validator->errors("engineCapacity"),
                "submissionDate" => $validator->errors("submissionDate"),
            ]);

            redirect("/add-car");
        }

        $carData = [
            'clientId' => $clientId,
            'workerId' => 1,
            'brand' => $brand,
            'model' => $model,
            'identificationNumber' => $identificationNumber,
            'color' => $color,
            'mileage' => $mileage,
            'engineCapacity' => $engineCapacity,
            'type' => $type,
            'status' => CarStatus::New->name,
            'admissionDate' => (new DateTime())->format('Y-m-d H:i:s'),
            'submissionDate' => $submissionDate
        ];

        $this->model->addCar($carData);
    }
}
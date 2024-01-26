<?php

namespace App\Controllers;

use App\Core\Commons\Session;
use App\Core\Twig\Twig;
use App\Models\ServiceModel;
use Valitron\Validator;

class ServiceController
{
    public function __construct(public readonly ServiceModel $model,  public readonly Twig $twig)
    {
    }

    public function addServiceIndex()
    {
        $carId = $_GET['carId'];

        $carModel = $this->model->getById("Car", $carId);
        if(!$carModel)
        {
            return $this->twig->render('errors/404.html.twig');
        }

        return $this->twig->render('service/create/add-service.html.twig', [
            "carId" => $carId
        ]);
    }

    public function updateServiceIndex()
    {
        $id = $_GET['id'];

        $serviceModel = $this->model->getById("Service", $id);
        if(!$serviceModel)
        {
            return $this->twig->render('errors/404.html.twig');
        }

        return $this->twig->render('service/update/update-service.html.twig', [
            "serviceModel" => $serviceModel
        ]);
    }

    public function addService()
    {
        $validator = new Validator($_POST);
        $validator->rules([
            "required" => [
                ["name"],
                ["cost"],
            ],
            "lengthBetween" => [
                ["name", 1, 50],
                ["comment", 0, 255],
            ]
        ]);

        $carId = $_POST["carId"];
        $name = $_POST["name"];
        $cost = $_POST["cost"];
        $comment = $_POST["comment"];

        if (!$validator->validate())
        {
            Session::flash("errors", [
                "name" => $validator->errors("name"),
                "cost" => $validator->errors("cost"),
                "comment" => $validator->errors("comment"),
            ]);

            redirect("/add-service?carId={$carId}");
        }

        $serviceData = [
          'CarId' => $carId,
          'Name' => $name,
          'Cost' => $cost,
          'comment' => $comment
        ];

        $this->model->addService($serviceData);
    }

    public function updateService()
    {
        $validator = new Validator($_POST);
        $validator->rules([
            "required" => [
                ["name"],
                ["cost"],
            ],
            "lengthBetween" => [
                ["name", 1, 50],
                ["comment", 0, 255],
            ]
        ]);

        $id = $_POST["serviceId"];
        $name = $_POST["name"];
        $cost = $_POST["cost"];
        $comment = $_POST["comment"];

        if (!$validator->validate())
        {
            Session::flash("errors", [
                "name" => $validator->errors("name"),
                "cost" => $validator->errors("cost"),
                "comment" => $validator->errors("comment"),
            ]);

            redirect("/update-service?id={$id}");
        }

        $serviceData = [
            'Name' => $name,
            'Cost' => $cost,
            'comment' => $comment
        ];

        $this->model->updateService($serviceData, $id);
    }
    
    public function deleteService()
    {
        $serviceId = $_GET["id"];
        
        $result = $this->model->deleteRecord("Service", "Id = {$serviceId}");
        if ($result) {
            redirect("/worker-cars");
        }
    }
}

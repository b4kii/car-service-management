<?php

namespace App\Controllers;

use App\Core\Commons\Session;
use App\Core\Twig\Twig;
use App\Models\WorkerModel;
use Ramsey\Uuid\Uuid;
use Valitron\Validator;

class WorkerController
{
    public function __construct(public readonly WorkerModel $model, public readonly Twig $twig)
    {
    }

    public function index()
    {
        return $this->twig->render('worker/add-client.html.twig');
    }

    public function addClient()
    {
        // LOGIKA DO GENEROWANIA KODU KLIENTA
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

        $this->model->addClient([$firstname, $lastname, $nip, $code, $type]);
    }
}
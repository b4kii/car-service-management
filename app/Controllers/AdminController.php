<?php

namespace App\Controllers;

use App\Core\Commons\Session;
use App\Core\Twig\Twig;
use App\Models\AdminModel;
use Valitron\Validator;

class AdminController
{
    public function __construct(public readonly AdminModel $model, public readonly Twig $twig)
    {
    }

    public function addWorkerIndex()
    {
        return $this->twig->render('admin/create/add-worker.html.twig');
    }

    public function updateWorkerIndex()
    {
        $id = $_GET['id'];

        $workerModel = $this->model->getById("User", $id);
        if(!$workerModel)
        {
            return $this->twig->render('errors/404.html.twig');
        }

        return $this->twig->render('admin/update/update-worker.html.twig', [
            "workerModel" => $workerModel
        ]);
    }

    public function addWorker()
    {
        $validator = new Validator($_POST);
        $validator->rules([
            "required" => [
                ["firstname"],
                ["lastname"],
                ["email"],
                ["phone"],
                ["login"],
                ["password"]
            ],
            "lengthBetween" => [
                ["firstname", 1, 10],
                ["lastname", 1, 20],
                ["phone", 1, 15],
                ["login", 1, 10],
                ["password", 8, 14],
            ],
            "email" => [
                ["email"]
            ]
        ]);

        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $role = $_POST["role"];
        $login = $_POST["login"];
        $password = $_POST["password"];

        if (!$validator->validate())
        {
            Session::flash("errors", [
                "firstname" => $validator->errors("firstname"),
                "lastname" => $validator->errors("lastname"),
                "phone" => $validator->errors("phone"),
                "email" => $validator->errors("email"),
                "login" => $validator->errors("login"),
                "password" => $validator->errors("password"),
            ]);

            redirect("/add-worker");
        }

        $workerData = [
          'Firstname' => $firstname,
          'Lastname' => $lastname,
          'Login' => $login,
          'Password' => $password,
          'Email' => $email,
          'Phone' => $phone,
          'Role' => $role
        ];

        $this->model->addWorker($workerData);
    }

    public function updateWorker()
    {
        $validator = new Validator($_POST);
        $validator->rules([
            "required" => [
                ["firstname"],
                ["lastname"],
                ["email"],
                ["phone"],
                ["login"],
                ["password"]
            ],
            "lengthBetween" => [
                ["firstname", 1, 10],
                ["lastname", 1, 20],
                ["phone", 1, 15],
                ["login", 1, 10],
                ["password", 8, 14],
            ],
            "email" => [
                ["email"]
            ]
        ]);

        $id = $_POST["workerId"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $role = $_POST["role"];
        $login = $_POST["login"];
        $password = $_POST["password"];

        if (!$validator->validate())
        {
            Session::flash("errors", [
                "firstname" => $validator->errors("firstname"),
                "lastname" => $validator->errors("lastname"),
                "phone" => $validator->errors("phone"),
                "email" => $validator->errors("email"),
                "login" => $validator->errors("login"),
                "password" => $validator->errors("password"),
            ]);

            redirect("/update-worker?id={$id}");
        }

        $workerData = [
            'Firstname' => $firstname,
            'Lastname' => $lastname,
            'Login' => $login,
            'Password' => $password,
            'Email' => $email,
            'Phone' => $phone,
            'Role' => $role
        ];

        $this->model->updateWorker($workerData, $id);
    }
}

<?php

namespace App\Models;

use App\Core\Commons\Session;

class LoginModel extends BaseModel
{
    public function loginUser($username): void
    {
        $user = $this->getUser("Login = '{$username}'");
        
        $user = [
            "username" => $user["Login"],
            "role" => $user["Role"],
            "firstName" => "First name",
            "lastName" => "Last name"
        ];
        
        Session::put("user", $user);
    }
    
    public function verifyUser($username, $password): bool
    {
        $user = $this->getUser("Login = '{$username}'");
        
        if ($user && password_verify($password, $user["Password"])) {
            return true;
        }
        return false;
    }
    
    public function getUser($condition)
    {
        return $this->getOneByCondition("User", $condition);
    }
}
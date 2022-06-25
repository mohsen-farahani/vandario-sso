<?php

namespace Vandar\Sso\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $id;

    public $mobile;

    public $email;

    public $fname;

    public $lname;

    public $fullName;

    public $nationalCode;

    public $birthDate;

    public $auth;

    public function setData(array $userData)
    {
        $this->id = $userData['id'];
        $this->mobile = $userData['mobile'];
        $this->email = $userData['email'];
        $this->fname = $userData['fname'];
        $this->lname = $userData['lname'];
        $this->fullName = $userData['full_name'];
        $this->nationalCode = $userData['national_code'];
        $this->birthDate = $userData['birth_date'];
        $this->auth = $userData['auth'] ?? null;
    }
}

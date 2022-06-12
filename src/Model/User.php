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

    public function setData(array $userDara)
    {
        $this->id = $userDara['id'];
        $this->mobile = $userDara['mobile'];
        $this->email = $userDara['email'];
        $this->fname = $userDara['fname'];
        $this->lname = $userDara['lname'];
        $this->fullName = $userDara['full_name'];
        $this->nationalCode = $userDara['national_code'];
        $this->birthDate = $userDara['birth_date'];
        $this->auth = $userDara['auth'] ?? null;
    }
}

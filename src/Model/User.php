<?php

namespace Vandar\Sso\Model;

class User
{
    public $id;

    public $mobile;

    public $fName;

    public $lName;

    public function __construct(array $userDara)
    {
        $this->id = $userDara['id'];
        $this->mobile = $userDara['mobile'];
        $this->fName = $userDara['f_name'];
        $this->lName = $userDara['l_name'];
    }
}

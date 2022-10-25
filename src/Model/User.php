<?php

namespace Vandar\Sso\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function setData(array $userData)
    {
        $this->id = $userData['id'];
        $this->mobile = $userData['mobile'];
        $this->email = $userData['email'];
        $this->fname = $userData['fname'];
        $this->lname = $userData['lname'];
        $this->name = $userData['name'];
        $this->national_code = $userData['national_code'];
        $this->birthdate = $userData['birthdate'];
        $this->auth = $userData['auth'] ?? null;
        $this->is_active = $userData['is_active'];
        $this->avatar = $userData['avatar'] ?? null;
    }
}

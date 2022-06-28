<?php

namespace Vandar\Sso\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    public $id;

    public $userId;

    public $name;

    public $provider;

    public $personalAccessClient;

    public $passwordClient;

    public $revoked;

    public function setData(array $clientData)
    {
        $this->id = $clientData['id'];

        $this->userId = $clientData['user_id'];

        $this->provider = $clientData['provider'];

        $this->personalAccessClient = $clientData['personal_access_client'];

        $this->passwordClient = $clientData['password_client'];
        
        $this->revoked = $clientData['revoked'];
    }
}

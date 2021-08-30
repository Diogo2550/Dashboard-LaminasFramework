<?php

namespace User\Model;

use Core\Model\AbstractCoreModelTable;
use Laminas\Crypt\Password\Bcrypt;

class UserTable extends AbstractCoreModelTable {

    public function save(array $data) {
        $token = null;
        if(isset($data['token'])) {
            $data['email_confirmed'] = true;
            unset($data['password']);
        }

        if(isset($data['password'])) {
            $data['password'] = (new Bcrypt())->create($data['password']);
        }

        if(!isset($data['id']) || count($data) == 2 && array_search('email', array_keys($data))) {
            $token = $this->generateToken();
        }

        $data['token'] = $token;

        return parent::save($data);
    }

    public function generateToken() {
        $token = sha1(uniqid(rand(10, 50)));

        return substr($token, 0, 32);
    }

    public function getUserByToken($token) {
        return $this->getBy(['token' => $token]);
    }

    public function getUserByEmail($email) {
        return $this->getBy(['email' => $email]);
    }
}
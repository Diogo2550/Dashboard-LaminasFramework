<?php

namespace User\Form;

use Laminas\Db\Adapter\Adapter;
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Email;
use Laminas\Form\Element\Password;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;
use User\Form\Filter\UserFilter;

class UserForm extends Form {

    public function __construct(Adapter $adapter) {
        parent::__construct('user', []);
        
        $this->setInputFilter(new UserFilter($adapter));
        $this->setAttribute('method', 'POST');

        $name = new Text('name');
        $name->setAttributes([
            'placeholder' => 'Nome completo',
            'class' => 'form-control',
            'maxlength' => 120,
        ]);

        $email = new Email('email');
        $email->setAttributes([
            'placeholder' => 'Email',
            'class' => 'form-control',
            'maxlength' => 120,
        ]);

        $password = new Password('password');
        $password->setAttributes([
            'placeholder' => 'Senha',
            'class' => 'form-control',
            'maxlength' => 48,
        ]);

        $verifyPassword = new Password('verifyPassword');
        $verifyPassword->setAttributes([
            'placeholder' => 'Repita sua senha',
            'class' => 'form-control',
            'maxlength' => 48,
        ]);

        $csrf = new Csrf('csrf');
        $csrf->setOptions([
            'csrf_options' => [
                'timeout' => 600
            ]
        ]);

        $this->add($name);
        $this->add($email);
        $this->add($password);
        $this->add($verifyPassword);
        $this->add($csrf);
    }
}
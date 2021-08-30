<?php

namespace User\Form;

use Laminas\Db\Adapter\Adapter;
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Email;
use Laminas\Form\Form;
use User\Form\Filter\NewPasswordFilter;

class NewPasswordForm extends Form {

    public function __construct(Adapter $adapter) {
        parent::__construct('new-password', []);

        $this->setInputFilter(new NewPasswordFilter);
        $this->setAttribute('method', 'POST');

        $email = new Email('email');
        $email->setAttributes([
            'placeholder' => 'Email',
            'class' => 'form-control',
            'maxlength' => 120,
        ]);

        $csrf = new Csrf('csrf');
        $csrf->setOptions([
            'csrf_options' => [
                'timeout' => 600
            ]
        ]);

        $this->add($email);
        $this->add($csrf);
    }

}
<?php

namespace User\Form\Filter;

use Laminas\Db\Adapter\Adapter;
use Laminas\InputFilter\Input;
use Laminas\InputFilter\InputFilter;
use Laminas\Validator\Db\NoRecordExists;
use Laminas\Validator\Identical;
use Laminas\Validator\NotEmpty;
use Laminas\Validator\StringLength;

class UserFilter extends InputFilter {
    public function __construct(Adapter $adapter) {
        $name = new Input('name');
        $name->setRequired(true)
            ->getFilterChain()->attachByName('stringtrim')->attachByName('StripTags');
        $name->getValidatorChain()->attach(new NotEmpty())
            ->attach(new StringLength(['max' => 120]));

        $this->add($name);

        $email = new Input('email');
        $email->setRequired(true)
            ->getFilterChain()->attachByName('stringtrim')->attachByName('StripTags');
        $email->getValidatorChain()->attach(new NotEmpty())
            ->attach(new StringLength(['max' => 255]))
            ->attach(new NoRecordExists([
                'table' => 'users',
                'field' => 'email',
                'adapter' => $adapter,
                'message' => [
                    'recordFount' => 'Endereço de email já existe.'
                ]
            ]));

        $this->add($email);

        $password = new Input('password');
        $password->setRequired(true)
            ->getFilterChain()->attachByName('stringtrim')->attachByName('StripTags');
        $password->getValidatorChain()->attach(new NotEmpty())
            ->attach(new StringLength(['max' => 48, 'min' => 8]))
            ->attach(new Identical([
                'token' => 'verifyPassword',
                'messages' => [
                    'notSame' => 'As senhas fornecidas não são idênticas.'
                ]
            ]));

        $this->add($password);
    }
}
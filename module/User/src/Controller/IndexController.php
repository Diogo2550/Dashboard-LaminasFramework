<?php

declare(strict_types=1);

namespace User\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function registerAction()
    {
        $this->layout()->setTemplate('user/layout/layout');

        return new ViewModel();
    }

    public function recoveredPasswordAction() {
        $this->layout()->setTemplate('user/layout/layout');

        return new ViewModel();        
    }

    public function newPasswordAction() {
        $this->layout()->setTemplate('user/layout/layout');
        
        return new ViewModel();        
    }

    public function confirmedEmailAction() {
        return new ViewModel();        
    }   
}

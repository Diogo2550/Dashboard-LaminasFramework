<?php
namespace Core\Factories;

use Interop\Container\ContainerInterface;
use Laminas\Mail\Transport\Smtp;
use Laminas\Mail\Transport\SmtpOptions;
use Laminas\ServiceManager\Factory\FactoryInterface;

class TransportSmtpFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $config = $container->get('config');
        $options = new SmtpOptions($config['mail']);
        $transport = new Smtp();
        $transport->setOptions($options);

        return $transport;
    }

}
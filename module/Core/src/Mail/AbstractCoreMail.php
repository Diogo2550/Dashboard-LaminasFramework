<?php

namespace Core\Mail;

use Laminas\Mail\Message as MailMessage;
use Laminas\Mail\Transport\Smtp;
use Laminas\Mime\Message;
use Laminas\Mime\Part;
use Laminas\Validator\File\MimeType;
use Laminas\View\View;

abstract class AbstractCoreMail {

    protected $transport;
    protected $view;
    protected $body;
    protected $message;
    protected $subject;
    protected $to;
    protected $replyTo;
    protected $data;
    protected $page;
    protected $cc;

    public function __construct(Smtp $transport, View $view, $page) {
        $this->transport = $transport;
        $this->view = $view;
        $this->page = $page;
    }

    // GETTERS
    public function getTransport() {
        return $this->transport;
    }

    public function getView() {
        return $this->view;
    }

    public function getBody() {
        return $this->body;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getTo() {
        return $this->to;
    }

    public function getReplyTo() {
        return $this->replyTo;
    }

    public function getData() {
        return $this->data;
    }

    public function getPage() {
        return $this->page;
    }

    public function getCc() {
        return $this->cc;
    }

    // SETTERES
    public function setTransport($transport) {
        $this->transport = $transport;

        return $this;
    }

    public function setView($view) {
        $this->view = $view;

        return $this;
    }

    public function setBody($body) {
        $this->body = $body;

        return $this;
    }

    public function setMessage($message) {
        $this->message = $message;

        return $this;
    }

    public function setSubject($subject) {
        $this->subject = $subject;

        return $this;
    }

    public function setTo($to) {
        $this->to = $to;

        return $this;
    }

    public function setReplyTo($replyTo) {
        $this->replyTo = $replyTo;

        return $this;
    }

    public function setData($data) {
        $this->data = $data;

        return $this;
    }

    public function setPage($page) {
        $this->page = $page;

        return $this;
    }

    public function setCc($cc) {
        $this->cc = $cc;

        return $this;
    }

    abstract public function renderView($page, View $view);

    public function prepare() {
        $html = new Part($this->renderView($this->page, $this->view));
        $html->type = 'text/html';

        $body = new Message();
        $body->setParts([$html]);

        $config = $this->transport->getOptions()->toArray();

        $this->message = new MailMessage();
        $this->message->addFrom($config['connection_string']['from'])
            ->addTo($this->to)
            ->setBody($this->body)
            ->setSubject($this->subject);
        
        if($this->cc) $this->message->addCc($this->cc);
        if($this->replyTo) $this->message->addReplyTo($this->replyTo);
        
        return $this;
    }

    public function send() {
        $this->transport->send($this->message);
    }

}
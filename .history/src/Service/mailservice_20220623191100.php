<?php


namespace App\Service;

use Twig\Environment;
use Doctrine\ORM\Query\Expr\from;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;



class mailservice {
public function __construct(MailerInterface $mailer,Environment $environment) 
{
    $this-> mailer = $mailer ;
    $this-> environment = $environment ;
}
    public function sendMail($data,$subject ="Creation compte"){
        $from = "djiamil02@outlook.fr";
        $email = (new Email())
        -> from($from)
        -> to ($data->getEmail())
        -> subject($subject)
        -> html({{ }});
    ;
        $this->mailer->send($email);
    }
}
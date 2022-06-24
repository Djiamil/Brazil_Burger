<?php


namespace App\Service;

use Doctrine\ORM\Query\Expr\from;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;



class mailservice {
public function __construct(MailerInterface $mailer,Environment) 
{
    $this-> mailer = $mailer ;
}
    public function sendMail($data,$subject ="Creation compte"){
        $from = "djiamil02@outlook.fr";
        $email = (new Email())
        -> from($from)
        -> to ($data->getEmail())
        -> subject($subject)
        -> html("<h1>Creation reussu</h1>");
    ;
        $this->mailer->send($email);
    }
}
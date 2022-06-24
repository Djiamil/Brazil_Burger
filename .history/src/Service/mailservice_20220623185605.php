<?php


namespace App\Service;

use Doctrine\ORM\Query\Expr\from;
use Symfony\Component\Mime\Email;



class mailservice {

    public function sendMail($data,$subject ="Creation compte"){
        $from = "djiamil02@outlook.fr";
        $email = (new Email())
        -> from($from)
        -> to ('moustaphader61@gmail.com',$data->getmail)
        -> subject($subject)
        -> html("<h1>Creation reussu</h1>");
    ;
    }
}
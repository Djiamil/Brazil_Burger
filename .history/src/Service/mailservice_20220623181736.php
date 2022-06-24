<?php


namespace App\Services;

use Doctrine\ORM\Query\Expr\From;
use Symfony\Component\Validator\Constraints\Email;


class mailservice {

    public function sendMail($data,$subject ="Creation compte"){
        $from = "djiamil02@outlook.fr";
        $email = (new Email())
        -> from($from)
        -> to ('moustaphader61@gmail.com') 

    ;
    }
}
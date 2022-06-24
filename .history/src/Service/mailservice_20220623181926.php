<?php


namespace App\Services;

use Doctrine\ORM\Query\Expr\from;



class mailservice {

    public function sendMail($data,$subject ="Creation compte"){
        $from = "djiamil02@outlook.fr";
        $email = (new Email())
        -> from($from)
        -> to ('moustaphader61@gmail.com')
        -> subject($subject);

    ;
    }
}
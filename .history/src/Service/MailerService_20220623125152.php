<?php
namespace App\Services;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class MailerService {


    public function __construct(MailerInterface $mailer) {
        $this->mailer = $mailer;
    }
    public function sendMail()
    {
        $mailer = new Email();
        $email -> from ()
        
    }
}
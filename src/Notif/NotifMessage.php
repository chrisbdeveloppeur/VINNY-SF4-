<?php


namespace App\Notif;

use App\Entity\Message;
use Twig\Environment;

class NotifMessage
{

    /**
     * NotifMessageconstructor.
     * @param \Swift_Mailer $mailer
     * @param Environment $renderer
     */
    private $mailer;
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }


    public function sendMessage(Message $message)
    {
        $mail = (new \Swift_Message('Message en provenance de vinnyvixi.com'))
            ->setFrom('admin@vinnyvixi.com')
            /**
             * Ci dessous entrez l'adresse de l'utilisateur concerné : $message->getEmail()
             */
            ->setTo(['christian.boungou@gmail.com','vinnyvixi@gmail.com','admin@vinnyvixi.com'])
            ->setReplyTo('admin@vinnyvixi.com')
            ->setBody($this->renderer->render('emails/message.html.twig',[
                'message' => $message,
            ]), 'text/html' );
        $this->mailer->send($mail);
    }

}
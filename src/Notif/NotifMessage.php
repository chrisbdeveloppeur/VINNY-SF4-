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
        $mail = (new \Swift_Message('Votre message à bien été envoyé'))
            ->setFrom('qleaq@gmail.com')
            /**
             * Ci dessous entrez l'adresse de l'utilisateur concerné : $message->getEmail()
             */
            ->setTo('kenshin91cb@gmail.com')
            ->setReplyTo($message->getEmail())
            ->setBody($this->renderer->render('emails/message.html.twig',[
                'message' => $message,
            ]), 'text/html' );
        $this->mailer->send($mail);
    }

}
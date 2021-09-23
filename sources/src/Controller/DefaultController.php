<?php
namespace App\Controller;

use App\Form\FeedbackForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PostRepository;
use App\Entity\Post;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Message;

class DefaultController extends AbstractController
{

    /**
     * this is controller for index page only
     * @author Kseniia Komarchuk <kseniia.komarchuk@gmail.com>
     * @Route("/", name="index_default")
     * @param PostRepository $postRepository
     * @return Response
     */
    public function postList(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
        return $this->render('default/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route ("feedback_contact", name="feedback_contact")
     * @param Request         $request
     * @param MailerInterface $mailer
     * @return Response
     */
    public function feedback(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(FeedbackForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $message = new Email();
            $message->from('burm.courses@gmail.com');
            $message->to('kseniia.komarchuk@gmail.com');
            $message->subject('Hello from Symfony!');
            $message->text(
                "Привет админ, \n"
                . $data['name'] . " прислал тебе обратную связь \n". $data['description']. "\n свяжись с ним по следующему контакту " . $data['contacts']. "\n удачи!"
            );
            $mailer->send($message);
            return $this->redirectToRoute('index_default');
        }
        return $this->render('default/feedback.html.twig', [
            'form' => $form->createView(),
        ]);
    }
};

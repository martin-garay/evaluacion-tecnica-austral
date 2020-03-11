<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\NewPasswordType;
use App\Form\Type\PasswordRequestType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResettingController extends AbstractController
{
    /**
     * @Route("/reset_password", name="reset_password", methods={"GET", "POST"})
     */
    public function resetPassword(Request $request, EntityManagerInterface $entityManager, \Swift_Mailer $mailer) {
        $form = $this->createForm(PasswordRequestType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $token = bin2hex(random_bytes(32));
            $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($user instanceof User) {
                $user->setPasswordRequestToken($token);
                $entityManager->flush();


                $link_reseteo = "http://localhost:8000/reset_password/confirm/$token";
                // send your email with SwiftMailer or anything else here
                $message = (new \Swift_Message('Turnos. Restablecer Contraseña'))
			        ->setFrom('test@unlu.edu.ar')
			        ->setTo($email)
			        ->setBody(
			            $this->renderView(
			                // templates/emails/registration.html.twig
			                'emails/registration.html.twig',
			                [
			                	'email' => $email,
			                	'link_reseteo' => $link_reseteo
			            	]
			            ),
			            'text/html'
			        )
			    ;

			    $mailer->send($message);

                $this->addFlash('success', "Se envio un mail a su casilla");

                return $this->redirectToRoute('reset_password');
            }else{
                $this->addFlash('error', "El usario no existe");                
            }
        }

        return $this->render('resetting/reset-password.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/reset_password/confirm/{token}", name="reset_password_confirm", methods={"GET", "POST"})
     */
    public function resetPasswordCheck(
        Request $request,
        string $token,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $encoder,
        TokenStorageInterface $tokenStorage,
        SessionInterface $session
    ) {
        $user = $entityManager->getRepository(User::class)->findOneBy(['passwordRequestToken' => $token]);

        if (!$token || !$user instanceof User) {
            $this->addFlash('danger', "El usuario no existe");

            return $this->redirectToRoute('reset_password');
        }

        $form = $this->createForm(NewPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('password')->getData();
            $password = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($password);
            $user->setPasswordRequestToken(null);
            $entityManager->flush();

            $token = new UsernamePasswordToken($user, $password, 'main');
            $tokenStorage->setToken($token);
            $session->set('_security_main', serialize($token));

            $this->addFlash('success', "Se cambio la contraseña correctamente");

            return $this->redirectToRoute('api_login');
        }

        return $this->render('resetting/reset-password-confirm.html.twig', ['form' => $form->createView()]);

    }
}
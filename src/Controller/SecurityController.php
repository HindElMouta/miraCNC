<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\LoginFormType; // Assurez-vous d'importer la classe du formulaire

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticAdmationUtils, Request $request): Response
    {
        // Créez le formulaire de connexion
        $form = $this->createForm(LoginFormType::class);

        // Récupérer les erreurs de connexion, le dernier nom d'utilisateur entré, etc.
        $error = $authenticAdmationUtils->getLastAuthenticationError();
        $lastUsername = $authenticAdmationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'form' => $form->createView(), // Passez le formulaire à la vue
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        // Cette méthode ne fait rien, elle est gérée par Symfony
    }
}

<?php

namespace App\Controller;

use App\Entity\Gebruiker;
use App\Form\GebruikerRegistratieFormType;
use App\Service\GebruikerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/registratie", name="registratie.")
 */
class RegistratieController extends AbstractController
{
    private $gebruikerService;

    /**
     * RegistratieController constructor.
     * @param GebruikerService $gebruikerService
     */
    public function __construct(GebruikerService $gebruikerService) {
        $this->gebruikerService = $gebruikerService;
    }

    /**
     * @Route("/", name="registratie")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function registratie(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $form = $this->createForm(GebruikerRegistratieFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $data = $form->getData();
            $gebruiker = new Gebruiker();
            $gebruiker->setGebruikersnaam($data->getGebruikersnaam());
            $gebruiker->setPassword($passwordEncoder->encodePassword($gebruiker, $data->getPassword()));
            $gebruiker->setVoornaam($data->getVoornaam());
            $gebruiker->setFamilienaam($data->getFamilienaam());
            $gebruiker->setStraat($data->getStraat());
            $gebruiker->setHuisnr($data->getHuisnr());
            $gebruiker->setPostcode($data->getPostcode());
            $gebruiker->setGemeente($data->getGemeente());
            $this->gebruikerService->save($gebruiker);

            $this->loginUser($gebruiker);
            return $this->redirect($this->generateUrl("home"));
        }

        return $this->render('registratie/index.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @param Gebruiker $gebruiker
     */
    private function loginUser(Gebruiker $gebruiker) : void
    {
        $token = new UsernamePasswordToken(
            $gebruiker,
            $gebruiker->getPassword(),
            'main',
            $gebruiker->getRoles()
        );

        $this->get('security.token_storage')->setToken($token);
        $this->get('session')->set('_security_main', serialize($token));
        $this->addFlash('success', 'You are now successfully registered!');
    }
}

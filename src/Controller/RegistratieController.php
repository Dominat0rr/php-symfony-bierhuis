<?php

namespace App\Controller;

use App\Entity\Gebruiker;
use App\Form\GebruikerRegistratieFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/registratie", name="registratie.")
 */
class RegistratieController extends AbstractController
{
    /**
     * @Route("/", name="registratie")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\Response
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
            $em = $this->getDoctrine()->getManager();
            $em->persist($gebruiker);
            $em->flush();

            return $this->redirect($this->generateUrl("app_login"));
        }

        return $this->render('registratie/index.html.twig', [
            "form" => $form->createView()
        ]);
    }
}

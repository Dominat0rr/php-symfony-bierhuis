<?php

namespace App\Controller;

use App\Entity\Bestelbon;
use App\Entity\Bestelbonlijn;
use App\Form\PlaatsBestellingFormType;
use App\Repository\BierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/mandje", name="mandje.")
 */
class MandjeController extends AbstractController
{
    /**
     * @Route("/", name="mandje")
     * @param BierRepository $bierRepository
     * @param Request $request
     * @param Security $security
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(BierRepository $bierRepository, Request $request, Security $security)
    {
        $form = $this->createForm(PlaatsBestellingFormType::class);
        $form->handleRequest($request);

        $bieren = [];
        //$bieren_mandje = array(4 => "2", 7 => "10");
        $session = $request->getSession();
        //$session->set("cart", $bieren_mandje);
        $bieren_mandje = $session->get("cart");

        if ($bieren_mandje === null) {
            return $this->render('mandje/index.html.twig');
        }

        foreach ($bieren_mandje as $key => $value) {
            $id = $key;
            $aantal = $value;

            $bier = $bierRepository->find($id);
            $bier->setAantal($aantal);
            array_push($bieren, $bier);
        }

        if ($form->isSubmitted()) {
            $bestelbonid = $this->plaatsBestelling($bieren, $security);

            // make cart (session) empty
            $session = $request->getSession();
            $session->set("cart", null);

            $this->addFlash("succes", "Bestelling met nummer \"" . $bestelbonid . "\" is succesvol geplaatst");
            return $this->redirect($this->generateUrl("home"));
        }

        return $this->render('mandje/index.html.twig', [
            "bieren" => $bieren,
            "form" => $form->createView()
        ]);
    }

    /**
     * @param Security $security
     * @param array $bieren
     */
    public function plaatsBestelling(array $bieren, Security $security) {
        $gebruiker = $security->getUser(); // null or UserInterface, if logged in
        $bestelbon = new Bestelbon();
        $bestelbon->setNaam($gebruiker->getGebruikersnaam());
        $bestelbon->setStraat($gebruiker->getStraat());
        $bestelbon->setHuisnr($gebruiker->getHuisnr());
        $bestelbon->setPostcode($gebruiker->getPostcode());
        $bestelbon->setGemeente($gebruiker->getGemeente());

        $em = $this->getDoctrine()->getManager();
        $em->persist($bestelbon);
        $em->flush();

        foreach($bieren as $bier) {
            $this->createBestelbonLijn($bestelbon, $bier);
        }

        return $bestelbon->getId();
    }

    public function createBestelbonLijn($bestelbon, $bier) {
        $bestelbonlijn = new Bestelbonlijn();
        $bestelbonlijn->setBestelbon($bestelbon);
        $bestelbonlijn->setBier($bier);
        $bestelbonlijn->setAantal($bier->getAantal());
        $bestelbonlijn->setPrijs($bier->getPrijs());

        $em = $this->getDoctrine()->getManager();
        $em->persist($bestelbonlijn);
        $em->flush();

        $this->updateBesteldAantalInBier($bier);
    }

    public function updateBesteldAantalInBier($bier) {
        $bier->setBesteld($bier->getBesteld() + $bier->getAantal());

        $em = $this->getDoctrine()->getManager();
        $em->persist($bier);
        $em->flush();
    }
}

<?php

namespace App\Controller;

use App\Entity\Bestelbon;
use App\Entity\Bestelbonlijn;
use App\Form\PlaatsBestellingFormType;
use App\Service\BestelbonlijnService;
use App\Service\BestelbonService;
use App\Service\BierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/mandje", name="mandje.")
 */
class MandjeController extends AbstractController
{
    private $bierService;
    private $bestelbonService;
    private $bestelbonlijnService;

    /**
     * MandjeController constructor.
     * @param BierService $bierService
     * @param BestelbonService $bestelbonService
     * @param BestelbonlijnService $bestelbonlijnService
     */
    public function __construct(BierService $bierService, BestelbonService $bestelbonService, BestelbonlijnService $bestelbonlijnService) {
        $this->bierService = $bierService;
        $this->bestelbonService = $bestelbonService;
        $this->bestelbonlijnService = $bestelbonlijnService;
    }

    /**
     * @Route("/", name="mandje")
     * @param Request $request
     * @param Security $security
     * @return Response
     */
    public function index(Request $request, Security $security)
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

            $bier = $this->bierService->findById($id);
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

    public function plaatsBestelling(array $bieren, Security $security) {
        $gebruiker = $security->getUser(); // null or UserInterface, if logged in
        $bestelbon = new Bestelbon();
        $bestelbon->setNaam($gebruiker->getGebruikersnaam());
        $bestelbon->setStraat($gebruiker->getStraat());
        $bestelbon->setHuisnr($gebruiker->getHuisnr());
        $bestelbon->setPostcode($gebruiker->getPostcode());
        $bestelbon->setGemeente($gebruiker->getGemeente());
        $this->bestelbonService->save($bestelbon);

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

        $this->bestelbonlijnService->save($bestelbonlijn);

        $this->updateBesteldAantalInBier($bier);
    }

    public function updateBesteldAantalInBier($bier) {
        $bier->setBesteld($bier->getBesteld() + $bier->getAantal());

        $this->bierService->update($bier);
    }
}

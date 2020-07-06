<?php

namespace App\Controller;

use App\Entity\Bier;
use App\Service\BierService;
use App\Form\BierAantalFormType;
use App\Service\BrouwerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bieren", name="bieren.")
 */
class BierController extends AbstractController
{
    private $bierService;
    private $brouwerService;

    /**
     * BierController constructor.
     * @param BierService $bierService
     * @param BrouwerService $brouwerService
     */
    public function __construct(BierService $bierService, BrouwerService $brouwerService) {
        $this->bierService = $bierService;
        $this->brouwerService = $brouwerService;
    }

    /**
     * @Route("/", name="bieren")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $brouwers = $this->brouwerService->findAll();
        //$bieren = $bierRepository->findAll();
        $page = ($request->query->get('page') != null && $request->query->get('page') != 0) ? $request->query->get('page') : 1;
        $limit = 20;
        $offset = ($page - 1)  * $limit;
        $bieren = $this->bierService->findAllWithPagination($limit, $offset);
        $aantalBieren = $this->bierService->getAantal();
        $aantalPaginas = ($aantalBieren % $limit == 0) ? roudn($aantalBieren / $limit, 0) : round($aantalBieren / $limit, 0) + 1;

        return $this->render('bier/index.html.twig', [
            "brouwers" => $brouwers,
            "bieren" => $bieren,
            "aantalPaginas" => $aantalPaginas,
            "page" => $page
        ]);
    }

    /**
     * @Route("/bier/{id}", defaults={"id"=null}, name="bier")
     * @param Request $request
     * @param Bier $bier
     * @return Response
     */
    public function bier(Request $request, Bier $bier = null) {
        $brouwers = $this->brouwerService->findAll();

        if ($bier === null) {
            return $this->render("bier/bier.html.twig", [
                "brouwers" => $brouwers,
                "bier" => $bier
            ]);
        }

        $form = $this->createForm(BierAantalFormType::class, $bier);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ((int)$request->get("bier_aantal_form")["aantal"] <= 0) {
                $this->addFlash("error", "Gelieve een geldig aantal in te voeren");
                return $this->redirect($this->generateUrl("bieren.bier", array("id" => $bier->getId())));
            }

            //$bier_mandje = array($request->attributes->get("id") => $request->get("bier_aantal_form")["aantal"]);
            $session = $request->getSession();
            $cartElements = $session->get("cart");
            $cartElements[$request->attributes->get("id")] = $request->get("bier_aantal_form")["aantal"];
            $session->set("cart", $cartElements);

            $this->addFlash("succes", "Bier \"" . $bier->getNaam() . "\" is succesvol toegevoegd aan uw mandje");
            return $this->redirect($this->generateUrl("mandje.mandje"));
        }

        return $this->render("bier/bier.html.twig", [
            "brouwers" => $brouwers,
            "bier" => $bier,
            "form" => $form->createView()
        ]);
    }
}

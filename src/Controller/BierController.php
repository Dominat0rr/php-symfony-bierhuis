<?php

namespace App\Controller;

use App\Entity\Bier;
use App\Form\BierAantalFormType;
use App\Repository\BierRepository;
use App\Repository\BrouwerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bieren", name="bieren.")
 */
class BierController extends AbstractController
{
    /**
     * @Route("/", name="bieren")
     * @param BrouwerRepository $brouwerRepository
     * @param BierRepository $bierRepository
     * @param Request $request
     * @return Response
     */
    public function index(BrouwerRepository $brouwerRepository, BierRepository $bierRepository, Request $request)
    {
        $brouwers = $brouwerRepository->findAll();
        //$bieren = $bierRepository->findAll();
        $page = ($request->query->get('page') != null && $request->query->get('page') != 0) ? $request->query->get('page') : 1;
        $limit = 20;
        $offset = ($page - 1)  * $limit;
        $bieren = $bierRepository->findPaginated($limit, $offset);
        $aantalPaginas = (1186 % $limit == 0) ? roudn(1186 / $limit, 0) : round(1186 / $limit, 0) + 1;

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
     * @param BrouwerRepository $brouwerRepository
     * @param Bier $bier
     * @return Response
     */
    public function bier(Request $request, BrouwerRepository $brouwerRepository, Bier $bier = null) {
        $brouwers = $brouwerRepository->findAll();

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

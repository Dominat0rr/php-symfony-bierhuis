<?php

namespace App\Controller;

use App\Entity\Brouwer;
use App\Service\BrouwerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/brouwers", name="brouwers.")
 */
class BrouwerController extends AbstractController
{
    private $brouwerService;

    /**
     * BrouwerController constructor.
     * @param BrouwerService $brouwerService
     */
    public function __construct(BrouwerService $brouwerService) {
        $this->brouwerService = $brouwerService;
    }

    /**
     * @Route("/", name="brouwers")
     * @return Response
     */
    public function index()
    {
        $brouwers = $this->brouwerService->findAll();

        return $this->render('brouwer/index.html.twig', [
            "brouwers" => $brouwers
        ]);
    }

    /**
     * @Route("/brouwer/{id}", defaults={"id"=null}, name="brouwer")
     * @param Request $request
     * @param Brouwer $brouwer
     * @return Response
     */
    public function brouwer(Request $request, Brouwer $brouwer = null) {
        $id = ($brouwer == null) ? (int)$request->query->get("id") : 0;
        $brouwers = $this->brouwerService->findAll();

        if ($brouwer == null && ($id == null || $id == 0)) {
            return $this->render("brouwer/brouwer.html.twig", [
                "brouwers" => $brouwers,
                "brouwer" => $brouwer
            ]);
        }

        if ($id != null || $id != 0) {
            $brouwer = $this->brouwerService->findById($id);

            if ($brouwer == null) {
                return $this->render("brouwer/brouwer.html.twig", [
                    "brouwers" => $brouwers,
                    "brouwer" => $brouwer
                ]);
            }
        }

        $bieren = $brouwer->getBier()->getValues();

        return $this->render("brouwer/brouwer.html.twig", [
            "brouwers" => $brouwers,
            "bieren" => $bieren,
            "brouwer" => $brouwer
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/error", name="error.")
 */
class ErrorController extends AbstractController
{
    /**
     * @Route("/", name="show")
     * @param FlattenException $exception
     * @return Response
     */
    public function show(FlattenException $exception)
    {
        $statusCode = $exception->getStatusCode();

        switch ($statusCode) {
            case 403:
                return $this->render('error/error403.html.twig');
                break;
            case 404:
                return $this->render('error/error404.html.twig');
                break;
            case 500:
                return $this->render('error/error500.html.twig');
                break;
            default:
                return $this->render('error/error.html.twig', [
                    "statusCode" => $statusCode
                ]);
                break;
        }

    }
}

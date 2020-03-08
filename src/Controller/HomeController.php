<?php

namespace App\Controller;

use Pusher\Pusher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\TurnoRepository;

class HomeController extends AbstractController
{    
    public function index(TurnoRepository $turnoRepository)
    {
    	//$estadistica = $turnoRepository->getEstadistica();
        return $this->render('index.html.twig', [
            'pusherKey' => $this->getParameter('pusherKey'),
            'pusherCluster' => $this->getParameter('pusherCluster'),
            'total_personas' => $turnoRepository->getCantidadTurnos(),
            'total_atendidos' => $turnoRepository->getCantidadAtendidos(),
            'total_no_atendidos' => $turnoRepository->getCantidadNoAtendidos()
        ]);        
    }
}
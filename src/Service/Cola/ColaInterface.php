<?php 
namespace App\Service\Cola;

use App\Repository\TurnoRepository;

interface ColaInterface{
	public function siguiente(TurnoRepository $turnoRepository);	
}

?>
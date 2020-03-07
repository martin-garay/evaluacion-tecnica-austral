<?php 
namespace App\Service\Cola;

use App\Repository\TurnoRepository;

class ColaFIFO implements ColaInterface{
		
	public function siguiente(TurnoRepository $turnoRepository){		
		return $turnoRepository->createQueryBuilder('t')
            ->andWhere('t.atendido = :val')
            ->setParameter('val', false)
            ->orderBy('t.fecha_creacion', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
	}
}

?>
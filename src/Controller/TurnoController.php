<?php
namespace App\Controller;
use App\Repository\TurnoRepository;
use App\Repository\ColaRepository;
use App\Entity\Turno;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PetController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class TurnoController
{
    private $turnoRepository;
    private $colaRepository;

    public function __construct(TurnoRepository $turnoRepository,ColaRepository $colaRepository)
    {
        $this->turnoRepository = $turnoRepository;
        $this->colaRepository = $colaRepository;
    }

    /**
     * @Route("sacar_turno/{id_cola}", name="sacar_un_turno", methods={"GET"})
     */
    public function sacarTurno($id_cola): JsonResponse
    {
        $cola = $this->colaRepository->findOneBy(['id' => $id_cola]);
        if(!$cola){
            throw new NotFoundHttpException('La cola no existe!');
        }
                
        $turno = $this->turnoRepository->sacarTurno($cola);        
        if(!$turno){
            throw new BadRequestHttpException('Error al crear el turno');
        }

        $data = [
            'id' => $turno->getId(),
            'id_cola' => $cola->getId(),
            'fecha_creacion' => $turno->getFechaCreacion(),
        ];
        return new JsonResponse($data, Response::HTTP_OK);
    }
    
            
}

?>
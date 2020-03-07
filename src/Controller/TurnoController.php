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
use App\Service\Cola\ColaInterface;
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
            return new JsonResponse("La cola no existe", Response::HTTP_NOT_FOUND);
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

     /**
     * @Route("atender_proximo/", name="atender_proximo", methods={"GET"})
     */
    public function atenderProximo(): JsonResponse
    {
        $turno = $this->turnoRepository->atenderProximo();
        if(!$turno){
            return new JsonResponse("No hay turno siguiente!", Response::HTTP_NOT_FOUND);            
        }
        $data = [
            'id_turno'=> $turno->getId(),
            'id_cola' => $turno->getCola()->getId()
        ];
        return new JsonResponse($data, Response::HTTP_OK);
    }

    
            
}

?>
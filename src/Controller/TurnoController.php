<?php
namespace App\Controller;
use App\Repository\TurnoRepository;
use App\Repository\ColaRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PetController
 * @package App\Controller
 *
 * @Route(path="/api/sacar_turno")
 */
class TurnoController
{
    private $turnoRepository;

    public function __construct(TurnoRepository $turnoRepository)
    {
        $this->turnoRepository = $turnoRepository;
    }

    /**
     * @Route("sacar_turno/{id_cola}", name="sacar_un_turno", methods={"GET"})
     */
    public function get($id_cola): JsonResponse
    {
        $cola = $this->ColaRepository->findOneBy(['id' => $id_cola]);
        if(!isset($cola)){
            throw new NotFoundHttpException('La cola no existe!');
        }
        $pet = $this->turnoRepository->findOneBy(['id' => $id]);

        $data = [
            'id' => $pet->getId(),
            'name' => $pet->getName(),
            'type' => $pet->getType(),
            'photoUrls' => $pet->getPhotoUrls(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $name = $data['name'];
        $type = $data['type'];
        $photoUrls = $data['photoUrls'];

        if (empty($name) || empty($type)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->petRepository->savePet($name, $type, $photoUrls);

        return new JsonResponse(['status' => 'Pet created!'], Response::HTTP_CREATED);
    }

}

?>
<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use App\Repository\PresenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresenceController
{
    private $presenceRepository;

    public function __construct(PresenceRepository  $presenceRepository)
    {
        $this->presenceRepository = $presenceRepository;
    }

    /**
     * @Route("/presence/{CIN}", name="presence_update", methods={"PUT"})
     */
    public function update($CIN, Request $request): JsonResponse
    {
        $presence = $this->presenceRepository->findOneBy(['CIN' => $CIN]);
        $data = json_decode($request->getContent(), true);

        $presence->setDates($data['date']);
        $updatedDate = $this->presenceRepository->updatePresence($presence);

        return new JsonResponse($updatedDate->toArray(), Response::HTTP_OK);
    }
    /**
     * @Route("/presence/get/{CIN}", name="presence_get", methods={"GET"})
     */
    public function get($CIN): JsonResponse
    {
        $presence = $this->presenceRepository->findOneBy(['CIN' => $CIN]);
        $data = [
            'CIN' => $presence->getCIN(),
            'dates' => $presence->getDates()
        ];
        return new JsonResponse($data, Response::HTTP_OK);
    }
}

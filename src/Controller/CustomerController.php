<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use App\Repository\PresenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController
{
    private $customerRepository;
    private $presenceRepository;

    

    public function __construct(CustomerRepository $customerRepository,PresenceRepository  $presenceRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->presenceRepository = $presenceRepository;
    }

    /**
     * @Route("/customers/add", name="add_cust", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

       $userName = $data['userName'];
       $password = $data['password'];
       $faceData = $data['faceData'];
       $status = $data['status'];
       $CIN = $data['CIN'];
       $Wage = $data['Wage'];
       $image = $data['image'];
       $workLocation = $data['workLocation'];



        $this->customerRepository->saveCustomer($userName, $password, $faceData,$status,$CIN,$Wage,$image,$workLocation);
        if($status == 'user'){
        $this->presenceRepository->savePresence($CIN);
        }
        return new JsonResponse(['status' => 'Customer created!'], Response::HTTP_CREATED);
    }
    /**
     * @Route("/customers/{CIN}", name="get_one_customer", methods={"GET"})
     */
    public function get($CIN): JsonResponse
    {
        $customer = $this->customerRepository->findOneBy(['CIN' => $CIN]);

        $data = [
            'userName' => $customer->getUserName(),
            'password' => $customer->getPassword(),
            'faceData' => $customer->getFaceData(),
            'status' => $customer->getStatus(),
            'Wage' => $customer->getWage(),
            'CIN' => $customer->getCIN(),
            'image' => $customer->getImage(),
            'workLocation' => $customer->getWorkLocation(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }
    /**
     * @Route("/customers", name="get_all_customers", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $customers = $this->customerRepository->findAll();
        $data = [];

        foreach ($customers as $customer) {
            $data['result'][]= [
            
                'userName' => $customer->getuserName(),
                'password' => $customer->getPassword(),
                'faceData' => $customer->getFaceData(),
                'status' => $customer->getStatus(),
                'CIN' => $customer->getCIN(),
                'Wage' => $customer->getWage(),
                'image' => $customer->getImage(),
                'workLocation' => $customer->getWorkLocation(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
    /**
     * @Route("/customers/{CIN}", name="update_customer", methods={"PUT"})
     */
    public function update($CIN, Request $request): JsonResponse
    {
        $customer = $this->customerRepository->findOneBy(['CIN' => $CIN]);
        $data = json_decode($request->getContent(), true);

        empty($data['userName']) ? true : $customer->setUserName($data['userName']);
        empty($data['password']) ? true : $customer->setPassword($data['password']);
        empty($data['faceData']) ? true : $customer->setFaceData($data['faceData']);
        empty($data['status']) ? true : $customer->setStatus($data['status']);
        empty($data['Wage']) ? true : $customer->setWage($data['Wage']);
        empty($data['CIN']) ? true : $customer->setCin($data['CIN']);
        empty($data['image']) ? true : $customer->setImage($data['image']);
        empty($data['workLocation']) ? true : $customer->setWorkLocation($data['workLocation']);
        $updatedCostumer = $this->customerRepository->updateCustomer($customer);

        return new JsonResponse($updatedCostumer->toArray(), Response::HTTP_OK);
    }
    /**
     * @Route("/customers/{CIN}", name="delete_customer", methods={"DELETE"})
     */
    public function delete($CIN): JsonResponse
    {
        $customer = $this->customerRepository->findOneBy(['CIN' => $CIN]);
        $presence = $this->presenceRepository->findOneBy(['CIN' => $CIN]);

        $this->customerRepository->removeCustomer($customer);
        $this->presenceRepository->removePresence($presence);

        return new JsonResponse(['status' => 'Customer deleted'], Response::HTTP_NO_CONTENT);
    }

}

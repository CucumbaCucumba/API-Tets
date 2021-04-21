<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController
{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
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

       // $firstName = $data['firstName'];
        //$lastName = $data['lastName'];
        //$email = $data['email'];
        //$phoneNumber = $data['phoneNumber'];
        //$faceData = $data['faceData'];

       // if (empty($firstName) || empty($lastName) || empty($email) || empty($phoneNumber) || empty($faceData) ) {
         //   throw new NotFoundHttpException('Expecting mandatory parameters!');
        //}

        $this->customerRepository->saveCustomer($userName, $password, $faceData,$status);

        return new JsonResponse(['status' => 'Customer created!'], Response::HTTP_CREATED);
    }
    /**
     * @Route("/customers/{id}", name="get_one_customer", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $customer = $this->customerRepository->findOneBy(['id' => $id]);

        $data = [
            'id' => $customer->getId(),
            'userName' => $customer->getUserName(),
            'lastName' => $customer->getLastName(),
            'faceData' => $customer->getFaceData(),
            'status' => $customer->getStatus(),
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
            $data[] = [
                'id' => $customer->getId(),
                'userName' => $customer->getuserName(),
                'password' => $customer->getPassword(),
                'faceData' => $customer->getFaceData(),
                'status' => $customer->getStatus(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
    /**
     * @Route("/customers/{id}", name="update_customer", methods={"PUT"})
     */
    public function update($id, Request $request): JsonResponse
    {
        $customer = $this->customerRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['firstName']) ? true : $customer->setFirstName($data['firstName']);
        empty($data['password']) ? true : $customer->setPassword($data['password']);
        empty($data['faceData']) ? true : $customer->setFaceData($data['faceData']);
        empty($data['status']) ? true : $customer->setStatus($data['status']);
        $updatedCostumer = $this->customerRepository->updateCustomer($customer);

        return new JsonResponse($updatedCostumer->toArray(), Response::HTTP_OK);
    }
    /**
     * @Route("/customers/{id}", name="delete_customer", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $customer = $this->customerRepository->findOneBy(['id' => $id]);

        $this->customerRepository->removeCustomer($customer);

        return new JsonResponse(['status' => 'Customer deleted'], Response::HTTP_NO_CONTENT);
    }

}

<?php

namespace App\Controller;

use App\Repository\PhoneRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PhoneController extends AbstractController
{
    /**
     * @Route("/api/phones", name="list_phone", methods={"GET"})
     */
    public function index(PhoneRepository $phoneRepository, NormalizerInterface $normalizer)
    {
        $phones = $phoneRepository->findAll();
        $phonesNormalises = $normalizer->normalize($phones);

        dd($phonesNormalises);

        return new Response('ok');
    }
}

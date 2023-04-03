<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Tax;

use App\Util\TaxCalculator;

class ProductController extends AbstractController
{
    #[Route('/', name: 'app_product')]
    public function index(Request $request, EntityManagerInterface $entityManager, TaxCalculator $taxCalculator): Response
    {
        $form = $this->createForm(ProductType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            $taxCalculator->setProduct($data['product']);
            $ctax = $taxCalculator->calc($data['code']);

            return $this->render('product/tax.html.twig', ['tax' => $ctax]);
        }
        return $this->render('product/index.html.twig',[
          'form' => $form,
        ]);
    }
}

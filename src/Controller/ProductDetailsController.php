<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductDetailsController extends AbstractController
{
    #[Route('/productDetails/{id}', name: 'product_details', methods: ['GET'])]
    public function show(int $id, ProductsRepository $productDetailsRepository): Response
    {
        // Récupérer le produit depuis la base de données
        $product = $productDetailsRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Produit non trouvé.');
        }
      

        // Récupérer les images associées au produit (si la méthode existe dans votre entité)
        // Assurez-vous que la méthode getImages() existe dans l'entité Product et retourne un tableau
        $image = $product->getImage(); // Remplacez cela par la méthode correcte pour récupérer les images



        return $this->render('product_details/index.html.twig', [
            'product' => $product,
            'image' => $image, // Passez les images à Twig
            
        ]);
    }
}

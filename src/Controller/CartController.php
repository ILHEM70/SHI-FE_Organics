<?php

namespace App\Controller;


use App\Repository\ProductsRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
 

    #[Route('/cart', name: 'app_cart', methods:['POST'])]
    public function index(SessionInterface $session, ProductsRepository $productRepository): Response
    {
        $panier = $session->get('panier', []);

        // Récupérer les produits à partir des IDs stockés dans le panier
        $data = [];

        foreach ($panier as $id => $quantity) {
            $product = $productRepository->find($id);
            if ($product) {
                $data[] = [
                    'product' => $product,
                    'quantity' => $quantity
                ];
            }
        }

        return $this->render('cart/index.html.twig', [
            'items' => $data
        ]);
    }
}

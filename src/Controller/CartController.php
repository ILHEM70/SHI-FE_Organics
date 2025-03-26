<?php

namespace App\Controller;


use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
 

    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session, ProductsRepository $productsRepository): Response
    {
        $panier = $session->get('panier', []);
        $products = [];
        foreach($panier as $key => $value){
            $products[$key] = $productsRepository->find($key);
        }

        return $this->render('cart/index.html.twig', [
            'items' => $products
        ]);
    }

    #[Route('/cart/add/', name: 'app_cart_add', methods: ['POST'])]
    public function add(SessionInterface $session, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $id = $data['id'];
        // On récupère la session panier si elle existe, sinon elle sera initialisée en tableau vide
        $panier = $session->get('panier', []);

        // si la clé qui correspond à l'id existe en tant que clé du tableau, alors on incrémente, sinon on ajoute 1 
        // La clé étant l'id du produit, elle va nous permettre de le retrouver lors de l'affichage
        if (isset($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);

        return new JsonResponse(['message' => "Produit ajouté au panier"]);
    }
}

<?php
//fichier généré avec la commande php bin/console make:crud
//contenant la totalité du crud 
namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductForm;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/product')] //on définit une anotation pdp, prefixe de chemin url pour toute la classe produite dans ce controleur
///prefixe /product
final class ProductController extends AbstractController
{
    #[Route(name: 'app_product_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response //injection de dépendance, methode index dépend de $product repository
    //symfony qui créer la valeur $productrepository (donne acces à findall) et l'injecte par la suite. Dans index on a injecté cette variable fournie.
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),  //dans la vue twig je peux utiliser la variable products contenant ma liste de produits afin de faire des boucles. 
        ]);
    }

    #[Route('/new', name: 'app_product_new', methods: ['GET', 'POST'])] //ligne 28 url est préfixe de la classe /product+/new 

    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductForm::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }
// normalement je devrai récupérer id du produit dans l'url , findbyid mais la symfony effectue cette méthode automatiquement
//demander un product qui correspond à l'id dans l'url et qui est affiché dans une vue twig. 
    #[Route('/{id}', name: 'app_product_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
//méthode get affiche le formulaire, méthode post soumet le formulaire, même url pour afficher et soummetre, mais la méthode change. 
//créer un formulaire à partir de product, si je l'enregistre post, si je laffiche get. 
    #[Route('/{id}/edit', name: 'app_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductForm::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_delete', methods: ['POST'])]
    public function delete(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
    }
}

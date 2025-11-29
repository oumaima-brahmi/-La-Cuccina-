<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Ingredient;
use App\Form\ProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/produit')]
class ProduitController extends AbstractController
{
    #[Route('/Search/{categorie}', name: 'app_produit_search', methods: ['GET','POST'])]
    public function Search(Request $request,EntityManagerInterface $entityManager,$categorie): Response
    {
        $search=$request->request->get('search');
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('p')
                     ->from(Produit::class, 'p')
                     ->where($queryBuilder->expr()->like('p.nom', ':search'))
                     ->andWhere('p.categorie = :categorie') 
             ->setParameters([
                 'search' => '%' . $search . '%',
                 'categorie' => $categorie
             ]);
             $produits = $queryBuilder->getQuery()->getResult();
            $ing = $entityManager
            ->getRepository(Ingredient::class)
            ->findByCategorie($categorie);

        return $this->render('produit/indexFront.html.twig', [
            'produits' => $produits,
            'ingredients'=>$ing,
            'categorie'=>$categorie,
        ]);
    }

    #[Route('/Rate/Sess/', name: 'store_product_in_session', methods: ['GET','POST'])]
    public function storeProductInSession(Request $request,EntityManagerInterface $entityManager): JsonResponse
{
    $data = json_decode($request->getContent(), true);

    if (!isset($data['productId']) || !isset($data['rate'])) {
        return new JsonResponse(['success' => false, 'message' => 'Product ID or rate not provided'], 400);
    }

    $productId = $data['productId'];

    $product = $entityManager
    ->getRepository(Produit::class)
    ->find($productId);

    $rate = $data['rate'];
    $product->setNote($rate);
    $entityManager->flush();

   
    $request->getSession()->set('rated_products', [$productId => $rate]);

    
    return new JsonResponse(['success' => true]);
}

    #[Route('/', name: 'app_produit_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $produits = $entityManager
            ->getRepository(Produit::class)
            ->findAll();

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
        ]);
    }
   
    #[Route('/Pizza', name: 'app_produit_index_pizza', methods: ['GET','POST'])]
    public function indexPizz(EntityManagerInterface $entityManager): Response
    {
        $produits = $entityManager
            ->getRepository(Produit::class)
            ->findByCategorie("PIZZA");
            $ing = $entityManager
            ->getRepository(Ingredient::class)
            ->findByCategorie("PIZZA");

        return $this->render('produit/indexFront.html.twig', [
            'produits' => $produits,
            'ingredients'=>$ing,
            'categorie'=>'PIZZA',
        ]);
    }
    #[Route('/Burger', name: 'app_produit_index_burger', methods: ['GET','POST'])]
    public function indexBurg(EntityManagerInterface $entityManager): Response
    {
        $produits = $entityManager
            ->getRepository(Produit::class)
            ->findByCategorie("BURGER");
            $ing = $entityManager
            ->getRepository(Ingredient::class)
            ->findByCategorie("BURGER");

        return $this->render('produit/indexFront.html.twig', [
            'produits' => $produits,
            'ingredients'=>$ing,
            'categorie'=>'BURGER'
        ]);
    }
    #[Route('/Pasta', name: 'app_produit_index_pasta', methods: ['GET','POST'])]
    public function indexPast(EntityManagerInterface $entityManager): Response
    {
        $produits = $entityManager
            ->getRepository(Produit::class)
            ->findByCategorie("PASTA");
            $ing = $entityManager
            ->getRepository(Ingredient::class)
            ->findByCategorie("PASTA");

        return $this->render('produit/indexFront.html.twig', [
            'produits' => $produits,
            'ingredients'=>$ing,
            'categorie'=>'PASTA'
        ]);
    }
    #[Route('/Asian', name: 'app_produit_index_asian', methods: ['GET','POST'])]
    public function indexAsian(EntityManagerInterface $entityManager): Response
    {
        $produits = $entityManager
            ->getRepository(Produit::class)
            ->findByCategorie("ASIANFOOD");
            $ing = $entityManager
            ->getRepository(Ingredient::class)
            ->findByCategorie("ASIANFOOD");

        return $this->render('produit/indexFront.html.twig', [
            'produits' => $produits,
            'ingredients'=>$ing,
            'categorie'=>'ASIAN'
        ]);
    }
    #[Route('/Salad', name: 'app_produit_index_salad', methods: ['GET','POST'])]
    public function indexSalad(EntityManagerInterface $entityManager): Response
    {
        $produits = $entityManager
            ->getRepository(Produit::class)
            ->findByCategorie("SALAD");
            $ing = $entityManager
            ->getRepository(Ingredient::class)
            ->findByCategorie("SALAD");

        return $this->render('produit/indexFront.html.twig', [
            'produits' => $produits,
            'ingredients'=>$ing,
            'categorie'=>'SALAD'
        ]);
    }

    #[Route('/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $targetDirectory = $this->getParameter('kernel.project_dir') . '/public';
            $file->move($targetDirectory, $fileName);

           
            $produit->setImage($fileName);
            $produit->setNote(0);
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $targetDirectory = $this->getParameter('kernel.project_dir') . '/public';
            $file->move($targetDirectory, $fileName);

           
            $produit->setImage($fileName);
            $entityManager->flush();

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\ContactForm;
use App\Form\CategoryType;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Form\handleRequest;
use function Symfony\Config\Monolog\persistent;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Entity\Product;
use App\Entity\User;
use App\Entity\Review;
use App\Form\ProductType;
use App\Repository\ReviewRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */

    public function listproduct(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine->getRepository('App\Entity\Product')->findAll();
        $categories = $doctrine->getRepository('App\Entity\Category')->findAll();
        return $this->render('home/index.html.twig', ['products' => $products, 'categories' => $categories, ]);
    }
    /**
     * @Route("home/details/{id}", name="details")
     */
    public
    function detailsAction(ManagerRegistry $doctrine, $id): Response
    {
        $products = $doctrine->getRepository('App\Entity\Product')->find($id);


        return $this->render('product/detail.html.twig', [
            'products' => $products]);
    }
}

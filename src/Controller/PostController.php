<?php

namespace App\Controller;
// include "data/posts.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="app_post")
     */
    public function index(): Response
    {
        include(__DIR__.'/../../data/posts.php');
        $posts= json_decode($posts);
        dump($posts);

        // return $this->render('post/index.html.twig', [
        //     'controller_name' => 'PostController',
        // ]);
        return $this->render('post/post.html.twig', [
            'posts' => $posts
            
        ]);
    }

     /**
     * @Route("/post/{id}", name="app_postId")
     */
    public function show($id): Response
    {
        include(__DIR__.'/../../data/posts.php');
        $posts= json_decode($id);
        dump($id);

        // return $this->render('post/index.html.twig', [
        //     'controller_name' => 'PostController',
        // ]);
        return $this->render('post/post.html.twig', [
            'posts' => $posts
        ]);
    }
}

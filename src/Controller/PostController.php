<?php

namespace App\Controller;
// include "data/posts.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController
{
    
    // public function index(): Response
    // {
    //     include(__DIR__.'/../../data/posts.php');
    //     $posts= json_decode($posts);
    //     dump($posts);

    //     // return $this->render('post/index.html.twig', [
    //     //     'controller_name' => 'PostController',
    //     // ]);
    //     return $this->render('post/post.html.twig', [
    //         'posts' => $posts
            
    //     ]);
    // }

    /**
     * @Route("/post", name="app_post")
     */
    public function index(Request $request): Response
    {
        include (__DIR__.'/../../data/posts.php');
        $data = json_decode($posts);

        $categories = [];

        foreach ($data as $item) {
            foreach ($item->tags as $tag) {
                if (!in_array($tag, $categories)) {
                    $categories[] = $tag;
                }
            }
        }

        $currentCategory = $request->query->get('category');

        if ($currentCategory != null) {
            $filteredData = [];

            foreach ($data as $item) {
                if (in_array($currentCategory, $item->tags)) {
                    $filteredData[] = $item;
                }
            }

            $data = $filteredData;
        }

        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
            'posts' => $data,
            'categories' => $categories,
            'currentCategory' => $currentCategory
        ]);
    }

    //  /**
    //  * @Route("/post/{id}", name="app_postId")
    //  */
    // public function show($id): Response
    // {
    //     include(__DIR__.'/../../data/posts.php');
    //     $posts= json_decode($id);
    //     dump($id);

    //     // return $this->render('post/index.html.twig', [
    //     //     'controller_name' => 'PostController',
    //     // ]);
    //     return $this->render('post/post.html.twig', [
    //         'posts' => $posts
    //     ]);
    // }

    /**
     * @Route("/post/{id}", name="app_postId")
     */
    public function id(int $id): Response
    {
        include (__DIR__.'/../../data/posts.php');
        $data = json_decode($posts);

        $post = null;

        foreach ($data as $item) {
            if ($item->id == $id) {
                $post = $item;
                break;
            }
        }

        if ($post == null) {
            return $this->render('post/notfound.html.twig', [
                'controller_name' => 'PostController',
                'id' => $id
            ]);
        }

        return $this->render('post/id.html.twig', [
            'controller_name' => 'PostController',
            'post' => $post
        ]);
    }
}

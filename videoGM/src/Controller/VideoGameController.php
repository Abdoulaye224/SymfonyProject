<?php

namespace App\Controller;

use App\Entity\VideoGame;
use App\Form\VideoGameType;
use App\Repository\VideoGameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\EditorController;


class VideoGameController extends AbstractController
{
    private $videoGameRepository;
    private $entityManager;

    public function __construct(VideoGameRepository $videoGameRepository, EntityManagerInterface $entityManager)
    {
        $this->videoGameRepository = $videoGameRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/videoGame_list", name="videoGame_list")
     */
    public function index()
    {
        $videoGames = $this->videoGameRepository->findAll();

        return $this->render('video_game/index.html.twig', [
            'controller_name' => 'VideoGameController',
            'videoGame_list' => $videoGames,
        ]);
    }

    /**
     * @Route("/videoGame-create", name="videoGame-create")
     */
    public function newAction(Request $request){

        $videoGame = new VideoGame();

        $form = $this->createForm(VideoGameType::class, $videoGame);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->persist($videoGame);
            $this->entityManager->flush();
            $this->addFlash('notice', "Le jeu a bien été crée");

            return $this->redirectToRoute('videoGame_list');
        }
        return $this->render('video_game/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function videoGameDetails($id){
        $videoGame = $this->videoGameRepository->find($id);
        return $this->render('video_game/details.html.twig', ['jeu' => $videoGame]);
    }
}

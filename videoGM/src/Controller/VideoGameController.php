<?php

namespace App\Controller;

use App\Entity\VideoGame;
use App\Form\VideoGameType;
use App\Repository\VideoGameRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



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

    /**
     * @Route("/deleteVG-bis/{id}", name="videoGame_delete_bis")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteBis(string $id, EntityManagerInterface $entityManager)
    {
        $videoGame = $this->videoGameRepository->find($id);
        $entityManager->remove($videoGame);
        $entityManager->flush();

        return $this->redirectToRoute('videoGame_list');
    }

    /**
     * @Route("/deleteVG/{id}", name="videoGame_delete")
     * @ParamConverter("videoGame", options={"mapping"={"id"="id"}})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(VideoGame $videoGame, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($videoGame);
        $entityManager->flush();

        return $this->redirectToRoute('videoGame_list');
    }

    /**
     * @Route("/editVG/{id}", name="videoGame_edit")
     * @ParamConverter("videoGame", options={"mapping"={"id"="id"}})
     * @IsGranted("ROLE_ADMIN")
     */
    public function update(Request $request, VideoGame $videoGame)
    {
        $form = $this->createForm(VideoGameType::class, $videoGame);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($videoGame);
            $this->entityManager->flush();
            $this->addFlash('notice', "Le jeu a bien été modifié");

            return $this->redirectToRoute('videoGame_list');
        }
        return $this->render('video_game/editVG.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/favoriteList", name="favoriteList")
     * @param VideoGame $videoGame
     * @IsGranted("ROLE_USER")
     * @return \Symfony\Component\HttpFoundation\Response

    public function addFavoriteList($id, EntityManagerInterface $entityManager){

        $videoGame = $this->videoGameRepository->find($id);
        $user = $this->getUser();
        $user->addFavoriteList($videoGame);
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'ajouter au Favori avec succes');

        return $this->render('video_game/favorite.html.twig', ['jeu' => $videoGame], ['user' => $user]);
    }*/
}

<?php

namespace App\Controller;

use App\Entity\Editor;
use App\Form\EditorType;
use App\Repository\EditorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EditorController extends AbstractController
{
    private $editorRepository;
    private $entityManager;

    public function __construct(EditorRepository $editorRepository, EntityManagerInterface $entityManager)
    {
        $this->editorRepository = $editorRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/editor_list", name="editor_list")
     */
    public function index()
    {
        $editors = $this->editorRepository->findAll();

        return $this->render('editor/index.html.twig', [
            'controller_name' => 'EditorController',
            'editorList' => $editors,
        ]);
    }

    /**
     * @Route("editor-create", name="editor-create")
     */

    public function newAction(Request $request)
    {
        $editor = new Editor();

        $form = $this->createForm(EditorType::class, $editor);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($editor);
            $this->entityManager->flush();
            $this->addFlash('notice', "L'editeur a bien été créé");

            return $this->redirectToRoute('editor_list');
        }
        return $this->render('editor/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

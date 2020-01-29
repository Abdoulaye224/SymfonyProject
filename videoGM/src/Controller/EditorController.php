<?php

namespace App\Controller;

use App\Entity\Editor;
use App\Entity\VideoGame;
use App\Form\EditorType;
use App\Form\VideoGameType;
use App\Repository\EditorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


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

    /**
     * @Route("/editorDetails/{id}", name="editorDetails")
     */
    public function editorDetails($id){
        $editor = $this->editorRepository->find($id);

        return $this->render('editor/details.html.twig', ['editor' => $editor]);
    }


    /**
     * @Route("/delete-bis/{id}", name="editor_delete_bis")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteBis(string $id, EntityManagerInterface $entityManager)
    {
        $editor = $this->editorRepository->find($id);
        $entityManager->remove($editor);
        $entityManager->flush();

        return $this->redirectToRoute('editor_list');
    }

    /**
     * @Route("/delete/{id}", name="editor_delete")
     * @ParamConverter("editor", options={"mapping"={"id"="id"}})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(editor $editor, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($editor);
        $entityManager->flush();

        return $this->redirectToRoute('editor_list');
    }

    /**
     * @Route("/edit/{id}", name="editor_edit")
     * @ParamConverter("editor", options={"mapping"={"id"="id"}})
     * @IsGranted("ROLE_ADMIN")
     */
    public function update(Request $request, editor $editor)
    {
        $form = $this->createForm(editorType::class, $editor);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($editor);
            $this->entityManager->flush();
            $this->addFlash('notice', "Le jeu a bien été modifié");

            return $this->redirectToRoute('editor_list');
        }
        return $this->render('editor/editVG.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}

<?php

namespace App\Controller;

use App\Entity\Chantiers;
use App\Form\ChantiersType;
use App\Repository\ChantiersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chantiers")
 */
class ChantiersController extends AbstractController
{
    /**
     * @Route("/", name="app_chantiers_index", methods={"GET"})
     */
    public function index(ChantiersRepository $chantiersRepository): Response
    {
        return $this->render('chantiers/index.html.twig', [
            'chantiers' => $chantiersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_chantiers_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ChantiersRepository $chantiersRepository): Response
    {
        $chantier = new Chantiers();
        $form = $this->createForm(ChantiersType::class, $chantier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chantiersRepository->add($chantier);
            return $this->redirectToRoute('app_chantiers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chantiers/new.html.twig', [
            'chantier' => $chantier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_chantiers_show", methods={"GET"})
     */
    public function show(Chantiers $chantier): Response
    {
        return $this->render('chantiers/show.html.twig', [
            'chantier' => $chantier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_chantiers_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Chantiers $chantier, ChantiersRepository $chantiersRepository): Response
    {
        $form = $this->createForm(ChantiersType::class, $chantier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chantiersRepository->add($chantier);
            return $this->redirectToRoute('app_chantiers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chantiers/edit.html.twig', [
            'chantier' => $chantier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_chantiers_delete", methods={"POST"})
     */
    public function delete(Request $request, Chantiers $chantier, ChantiersRepository $chantiersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chantier->getId(), $request->request->get('_token'))) {
            $chantiersRepository->remove($chantier);
        }

        return $this->redirectToRoute('app_chantiers_index', [], Response::HTTP_SEE_OTHER);
    }
}

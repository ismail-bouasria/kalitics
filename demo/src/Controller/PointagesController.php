<?php

namespace App\Controller;

use App\Entity\Pointages;
use App\Form\PointagesType;
use App\Repository\PointagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pointages")
 */
class PointagesController extends AbstractController
{
    /**
     * @Route("/", name="app_pointages_index", methods={"GET"})
     */
    public function index(PointagesRepository $pointagesRepository): Response
    {
        return $this->render('pointages/index.html.twig', [
            'pointages' => $pointagesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_pointages_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PointagesRepository $pointagesRepository): Response
    {
        $pointage = new Pointages();
        $pointage->setDate(new \DateTime());
        $form = $this->createForm(PointagesType::class, $pointage);
        $form->handleRequest($request);
        $date = \DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
        $data = json_decode($request->getContent(), true);

        if ($data) {
            $utilisateurId = $data['utilisateurId'];
            $chantierId = $data['chantierId'];
            $duree = $data['dureeHeures'];

            $existantPointage = $pointagesRepository->findOneBy([
                'utilisateur' => $utilisateurId,
                'chantier' => $chantierId,
                'date' => $date,
            ]);

            if ($existantPointage) {
                return new JsonResponse([
                    'errorPointage' => 'Un pointage existe déjà pour ce chantier !'
                ]);
            }

            $limiteHeures = $pointagesRepository->sumPointageByUtilisateur($utilisateurId)[0]['heures'] + $duree;
            $limiteDate = $date->modify('+5 days');

            if ($limiteHeures > 35 && $date >= $limiteDate) {
                return new JsonResponse([
                    'errorTimeLimite' => "Nombre d'heures maximum cumulé est atteint !"
                ]);
            }
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $pointagesRepository->add($pointage);
            return $this->redirectToRoute('app_pointages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pointages/new.html.twig', [
            'pointage' => $pointage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_pointages_show", methods={"GET"})
     */
    public function show(Pointages $pointage): Response
    {
        return $this->render('pointages/show.html.twig', [
            'pointage' => $pointage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_pointages_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Pointages $pointage, PointagesRepository $pointagesRepository): Response
    {
        $form = $this->createForm(PointagesType::class, $pointage);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $pointagesRepository->add($pointage);
            return $this->redirectToRoute('app_pointages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pointages/edit.html.twig', [
            'pointage' => $pointage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_pointages_delete", methods={"POST"})
     */
    public function delete(Request $request, Pointages $pointage, PointagesRepository $pointagesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $pointage->getId(), $request->request->get('_token'))) {
            $pointagesRepository->remove($pointage);
        }

        return $this->redirectToRoute('app_pointages_index', [], Response::HTTP_SEE_OTHER);
    }
}

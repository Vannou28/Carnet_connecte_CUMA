<?php

namespace App\Controller;

use DateTime;
use App\Entity\WhereMaterial;
use App\Form\WhereMaterialType;
use App\DataFixtures\MaterialFixtures;
use App\Repository\MaterialRepository;
use App\Repository\WhereMaterialRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/where/material")
 */

class WhereMaterialController extends AbstractController
{
    /**
     * @Route("/", name="where_material_index", methods={"GET"})
     */
    public function index(WhereMaterialRepository $whereMaterialRepo): Response
    {
        return $this->render('where_material/index.html.twig', [
            'where_materials' => $whereMaterialRepo->findAll(),
        ]);
    }

    /**
     * @Route("/un_materiel", name="where_One_material")
     */
    public function indexOneMaterial(
        Request $request,
        WhereMaterialRepository $whereMaterialRepo,
        MaterialRepository $materialRepository
    ): Response {
        $whereMaterial = new WhereMaterial();
        $form = $this->createForm(WhereMaterialType::class, $whereMaterial);
        $form->handleRequest($request);
        $oneMaterial = $materialRepository->findOneByName(['name' => MaterialFixtures::MATERIALS[0]['name']]);
        if ($form->isSubmitted() && $form->isValid()) {
            $material = $form->getData();
            $oneMaterial = $material->getMaterial();
        }

        return $this->render('where_material/viewOneMaterial.html.twig', [
            'where_material' => $whereMaterialRepo->findOneByMaterial(['material' => $oneMaterial->getId()]),
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/new", name="where_material_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $whereMaterial = new WhereMaterial();
        $form = $this->createForm(WhereMaterialType::class, $whereMaterial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $whereMaterial->setUser($this->getUser());
            $whereMaterial->setTakeDate(new DateTime('now'));
            $entityManager->persist($whereMaterial);
            $entityManager->flush();

            return $this->redirectToRoute('where_material_index');
        }

        return $this->render('where_material/new.html.twig', [
            'where_material' => $whereMaterial,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="where_material_show", methods={"GET"})
     */
    public function show(WhereMaterial $whereMaterial): Response
    {
        return $this->render('where_material/show.html.twig', [
            'where_material' => $whereMaterial,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="where_material_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, WhereMaterial $whereMaterial): Response
    {
        $form = $this->createForm(WhereMaterialType::class, $whereMaterial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('where_material_index');
        }

        return $this->render('where_material/edit.html.twig', [
            'where_material' => $whereMaterial,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="where_material_delete", methods={"POST"})
     */
    public function delete(Request $request, WhereMaterial $whereMaterial): Response
    {
        if ($this->isCsrfTokenValid('delete' . $whereMaterial->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($whereMaterial);
            $entityManager->flush();
        }

        return $this->redirectToRoute('where_material_index');
    }
}

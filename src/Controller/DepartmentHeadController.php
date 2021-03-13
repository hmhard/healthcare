<?php

namespace App\Controller;

use App\Entity\DepartmentHead;
use App\Form\DepartmentHeadType;
use App\Repository\DepartmentHeadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/department-head")
 */
class DepartmentHeadController extends AbstractController
{
    /**
     * @Route("/", name="department_head_index", methods={"GET"})
     */
    public function index(DepartmentHeadRepository $departmentHeadRepository): Response
    {
        return $this->render('department_head/index.html.twig', [
            'department_heads' => $departmentHeadRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="department_head_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $departmentHead = new DepartmentHead();
        $form = $this->createForm(DepartmentHeadType::class, $departmentHead);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($departmentHead);
            $entityManager->flush();

            return $this->redirectToRoute('department_head_index');
        }

        return $this->render('department_head/new.html.twig', [
            'department_head' => $departmentHead,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="department_head_show", methods={"GET"})
     */
    public function show(DepartmentHead $departmentHead): Response
    {
        return $this->render('department_head/show.html.twig', [
            'department_head' => $departmentHead,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="department_head_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DepartmentHead $departmentHead): Response
    {
        $form = $this->createForm(DepartmentHeadType::class, $departmentHead);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('department_head_index');
        }

        return $this->render('department_head/edit.html.twig', [
            'department_head' => $departmentHead,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="department_head_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DepartmentHead $departmentHead): Response
    {
        if ($this->isCsrfTokenValid('delete'.$departmentHead->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($departmentHead);
            $entityManager->flush();
        }

        return $this->redirectToRoute('department_head_index');
    }
}

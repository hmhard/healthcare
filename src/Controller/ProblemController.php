<?php

namespace App\Controller;

use App\Entity\Problem;
use App\Form\ProblemType;
use App\Repository\ProblemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/problem")
 */
class ProblemController extends AbstractController
{
    /**
     * @Route("/", name="problem_index", methods={"GET"})
     */
    public function index(ProblemRepository $problemRepository): Response
    {
        return $this->render('problem/index.html.twig', [
            'problems' => $problemRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="problem_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $problem = new Problem();
        $form = $this->createForm(ProblemType::class, $problem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($problem);
            $entityManager->flush();

            return $this->redirectToRoute('problem_index');
        }

        return $this->render('problem/new.html.twig', [
            'problem' => $problem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="problem_show", methods={"GET"})
     */
    public function show(Problem $problem): Response
    {
        return $this->render('problem/show.html.twig', [
            'problem' => $problem,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="problem_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Problem $problem): Response
    {
        $form = $this->createForm(ProblemType::class, $problem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('problem_index');
        }

        return $this->render('problem/edit.html.twig', [
            'problem' => $problem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="problem_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Problem $problem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$problem->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($problem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('problem_index');
    }
}

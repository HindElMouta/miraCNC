<?php

namespace App\Controller;

use App\Entity\Machine;
use App\Form\MachineType;
use App\Repository\MachineRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MachineController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/machine", name="machine_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $sort = $request->query->get('sort', 'id'); // Obtenez le critère de tri depuis l'URL
        $search = $request->query->get('search', ''); // Obtenez le critère de recherche depuis l'URL

        $machines = $this->entityManager->getRepository(Machine::class)->findBySearchAndSort($search, $sort);

        return $this->render('machine/machine.html.twig', [
            'machines' => $machines,
            'currentSort' => $sort, // Passer le critère de tri actuel pour mettre en surbrillance le lien correspondant dans le template
            'currentSearch' => $search, // Passer le critère de recherche actuel pour afficher dans le formulaire de recherche
        ]);
    }

    /**
     * @Route("/machine/{id}", name="machine_show", methods={"GET"})
     */
    public function show(int $id, MachineRepository $machineRepository): Response
    {
        $machine = $machineRepository->find($id);

        if (!$machine) {
            throw $this->createNotFoundException('Machine not found');
        }

        return $this->render('machine/show.html.twig', [
            'machine' => $machine,
        ]);
    }

    /**
     * @Route("/machine/add", name="machine_add", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function add(Request $request, FileUploader $fileUploader): Response
    {
        $machine = new Machine();
        $form = $this->createForm(MachineType::class, $machine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form['imgFilename']->getData();
            if ($uploadedFile) {
                $imgFilename = $fileUploader->upload($uploadedFile);
                $machine->setImgFilename($imgFilename);
            }

            $this->saveMachine($machine);

            return $this->redirectToRoute('machine_index');
        }

        return $this->render('machine/add.html.twig', [
            'machine' => $machine,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/machine/edit/{id}", name="machine_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Machine $machine): Response
    {
        $form = $this->createForm(MachineType::class, $machine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->saveMachine($machine);

            return $this->redirectToRoute('machine_index');
        }

        return $this->renderForm('machine/edit.html.twig', [
            'machine' => $machine,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/machine/delete/{id}", name="machine_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Machine $machine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$machine->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($machine);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('machine_index');
    }

    /**
     * Save a machine entity.
     */
    private function saveMachine(Machine $machine): void
    {
        $this->entityManager->persist($machine);
        $this->entityManager->flush();
    }
}

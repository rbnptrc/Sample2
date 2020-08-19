<?php

namespace App\Controller;

use App\Entity\Mushroom;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class MushroomController extends AbstractController
{
    /**
     * @Route("/webshop",methods={"GET"}, name="webshop")
     *
     * @return Response
     */
    public function index(Request $request)
    {
        try {
            $mushroom = new Mushroom();
            $mushrooms = $this->getDoctrine()->getRepository(Mushroom::class);

            $mushrooms = $mushrooms->findAll();

            return $this->render('mushrooms/index.html.twig', [
                'mushrooms' => $mushrooms,
                'mushroomCount' => $mushroom->getMushroomCount(new Session()),
            ]);
        } catch (\Exception $exception) {
            return $this->render('error.html.twig', [
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * @Route("/admin/mushroom-create",name="mushroom-create",methods={"GET","POST"})
     *
     * @throws \Exception
     *
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        try {
            $mushroom = new Mushroom();
            $mushroom->setCreatedAt(new \DateTime());
            $form = $this->createFormBuilder($mushroom)
                ->add('name', TextType::class, [
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('unit_price', NumberType::class, [
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('quantity', NumberType::class, [
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('stock', NumberType::class, [
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('img', TextType::class, [
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('description', TextareaType::class, [
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('save', SubmitType::class, [
                    'label' => 'Save',
                    'attr' => ['class' => 'btn btn-primary mt-3'],
                ])
                ->getForm()
            ;
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                $entityManage = $this->getDoctrine()->getManager();
                $entityManage->persist($data);
                $entityManage->flush();

                return $this->redirect('/');
            }

            return $this->render('mushrooms/create.html.twig', [
                'mushroom' => $mushroom,
                'form' => $form->createView(),
            ]);
        } catch (\Exception $exception) {
            return $this->render('error.html.twig', [
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * @Route("/admin/edit/{id}", name="edit_mushroom")
     *
     * @param mixed $id
     */
    public function editEvent($id, Request $request)
    {
        $mushroom = $this->getDoctrine()->getRepository(Mushroom::class)->find($id);

        $form = $this->createFormBuilder($mushroom)
            ->add('name', TextType::class, [
                'label' => 'Product Name: *',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('unit_price', NumberType::class, [
                'label' => 'Product Price: *',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('quantity', NumberType::class, [
                'label' => 'Quantity (g): *',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('stock', NumberType::class, [
                'label' => 'Available Stock (g): *',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('img', TextType::class, [
                'label' => 'Picture (url): *',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save',
                'attr' => ['class' => 'btn btn-primary mt-3'],
            ])
            ->getForm()
        ;

        $form->setData($mushroom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $updatedMushroom = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $this->addFlash(
                'notice',
                'Mushroom Edited Successfully'
            );

            $em->persist($updatedMushroom);
            $em->flush();

            return $this->redirectToRoute('webshop');
        }

        return $this->render('mushrooms/create.html.twig', ['form' => $form->createView(), 'id' => $id]);
    }

    /**
     * @Route(path="/webshop/mushroom/{id}", name="mushroom",methods={"GET","POST"})
     *
     * @param $id
     *
     * @return Response
     */
    public function show(Request $request, $id)
    {
        try {
            $mushroom = $this->getDoctrine()->getRepository(Mushroom::class)->find($id);
            $form = $this->createFormBuilder()
                ->add('qty', ChoiceType::class, [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'choices' => ['1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5],
                ])
                ->add('save', SubmitType::class, [
                    'label' => 'Add to cart',
                    'attr' => [
                        'class' => 'btn btn-primary mt-3',
                    ],
                ])
                ->getForm()
            ;
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                $session = new Session();
                $items = [];
                if ($session->get('cart')) {
                    $items = $session->get('cart');
                }
                array_push(
                    $items,
                    [
                        'id' => $id,
                        'name' => $mushroom->getName(),
                        'unit_price' => $mushroom->getunit_price(),
                        'price' => $mushroom->getunit_price() * $data['qty'],
                        'qty' => $data['qty'],
                    ]
                );
                $session->set('cart', $items);

                $this->addFlash(
                    'notice',
                    'Added to the Cart Succesfully'
                );

                return $this->redirect('/webshop');
            }

            return $this->render('mushrooms/show.html.twig', [
                'mushroom' => $mushroom,
                'form' => $form->createView(),
            ]);
        } catch (\Exception $exception) {
            return $this->render('error.html.twig', [
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * @Route("/admin/delete/{id}")
     *
     * @param mixed $id
     */
    public function deleteMushroom($id)
    {
        $em = $this->getDoctrine()->getManager();
        $mushroom = $em->getRepository(Mushroom::class)->find($id);

        if (!$mushroom) {
            throw $this->createNotFoundException(
                'No record for the mushroom with the id: '.$id
            );
        }

        $this->addFlash(
            'notice',
            'Mushroom Deleted Successfully'
        );

        $em->remove($mushroom);
        $em->flush();

        return $this->redirectToRoute('webshop');
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return $this->render('admin.html.twig');
    }
}

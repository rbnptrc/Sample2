<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LaGombaController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('lagomba/index.html.twig');
    }

    /**
     * @Route("/nora", name="nora")
     */
    public function nora()
    {
        return $this->render('lagomba/nora.html.twig');
    }

    /**
     * @Route("/products", name="products")
     */
    public function products()
    {
        return $this->render('lagomba/product.html.twig');
    }

    /**
     * @Route("/recipes", name="recipes")
     */
    public function recipes()
    {
        return $this->render('lagomba/recipes.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request)
    {
        $contact = new Contact();

        $form = $this->createFormBuilder($contact)->
                add('name', TextType::class, ['attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])->
                add('email', TextType::class, ['attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px']])->
                add('message', TextareaType::class, ['attr' => ['class' => 'form-control', 'style' => 'margin-bottom:10px', 'rows' => '5']])->
                add('submit', SubmitType::class, ['label' => 'Send', 'attr' => ['class' => 'btn btn-warning font-weight-bold text-secondary', 'style' => 'margin-bottom:10px']])
                    ->getForm()
                ;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $name = $form['name']->getData();
            $email = $form['email']->getData();
            $message = $form['message']->getData();

            $contact->setName($name);
            $contact->setMessage($message);
            $contact->setEmail($email);
            $contact->setSendDate(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $this->addFlash(
                'notice',
                'Your message has been received! Thank you!'
            );

            return $this->redirectToRoute('contact');
        }

        return $this->render('lagomba/contact.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/showAll", name="showAll")
     */
    public function showAll()
    {
        $contact = $this->getDoctrine()->getRepository('App:Contact')->findAll();

        return $this->render('lagomba/showMessage.html.twig', ['contact' => $contact]);
    }

    /**
     * @Route("/admin/details/{id}", name="details")
     *
     * @param mixed $id
     */
    public function detailsAction($id)
    {
        $contact = $this->getDoctrine()->getRepository('App:Contact')->find($id);

        return $this->render('lagomba/detailMessage.html.twig', ['contact' => $contact]);
    }

    /**
     * @Route("/admin/delete-msg/{id}", name="delete_msg")
     *
     * @param mixed $id
     */
    public function deleteMsg($id)
    {
        $em = $this->getDoctrine()->getManager();
        $contact = $em->getRepository(Contact::class)->find($id);

        if (!$contact) {
            throw $this->createNotFoundException(
                'No message with the id: '.$id
            );
        }

        $this->addFlash(
            'notice',
            'Message Deleted Successfully'
        );

        $em->remove($contact);
        $em->flush();

        return $this->redirectToRoute('showAll');
    }
}

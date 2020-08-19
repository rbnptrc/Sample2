<?php

namespace App\Controller;

use App\Entity\Recipes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response ;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RecipesController extends AbstractController
{
    /**
     * @Route("/admin/create-recipe", name="create-recipe", methods={"GET", "POST"})
     * 
     * @return Response
     */
    public function create(Request $request)
    {
        $recipes = new Recipes;

        $form = $this->createFormBuilder($recipes)
        ->add('image', TextType::class, array('label'=>'Upload File','attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))        ->add('s', TextareaType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('one', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('two', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('three', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('four', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('five', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('six', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('seven', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('eight', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('nine', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('zehn', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('eleven', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('twelve', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('thirteen', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('fourteen', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('fifteen', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('preptime', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('preplevel', ChoiceType::class, array('choices'=>array('hard'=>'hard', 'medium'=>'medium', 'easy'=>'easy'),'attr' => array('class'=> 'form-control', 'style'=>'margin-botton:15px')))
        ->add('save', SubmitType::class, array('label'=> 'Create Recipe', 'attr' => array('class'=> 'btn-primary', 'style'=>'margin-bottom:15px')))
        ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $image = $form['image']->getData();
            $one = $form['one']->getData();
            $two = $form['two']->getData();
            $three = $form['three']->getData();
            $four= $form['four']->getData();
            $five = $form['five']->getData();
            $six = $form['six']->getData();
            $seven = $form['seven']->getData();
            $eight = $form['eight']->getData();
            $nine = $form['nine']->getData();
            $zehn = $form['zehn']->getData();
            $eleven = $form['eleven']->getData();
            $twelve = $form['twelve']->getData();
            $thirteen = $form['thirteen']->getData();
            $fourteen = $form['fourteen']->getData();
            $fifteen = $form['fifteen']->getData();            
            $preptime = $form['preptime']->getData();
            $preplevel = $form['preplevel']->getData();


            $recipes->setImage($image);
            $recipes->setone($one);
            $recipes->settwo($two);
            $recipes->setthree($three);
            $recipes->setfour($four);
            $recipes->setfive($five);
            $recipes->setsix($six);
            $recipes->setseven($seven);
            $recipes->seteight($eight);
            $recipes->setnine($nine);
            $recipes->setZehn($zehn);
            $recipes->seteleven($eleven);
            $recipes->settwelve($twelve);
            $recipes->setthirteen($thirteen);
            $recipes->setfourteen($fourteen);
            $recipes->setfifteen($fifteen);
            $recipes->setPrepTime($preptime);
            $recipes->setPrepLevel($preplevel);

            /*$file = $request->files->get('post')['image'];

            $uploads_directory= $this->getParameter('uploads_directory');
            $filename =md5(uniqid()) . '.' . $file->guessExtension();
            $image->move(
                $uploads_directory, $filename
            );
*/
            $em = $this->getDoctrine()->getManager();
            $em->persist($recipes);

            $em->flush();
            $this->addFlash(
                    'notice',
                    'Your Recipe has been Added'
                    );
            return $this->redirectToRoute('home');

        }


        return $this->render('recipes/create.html.twig', array('form' => $form->createView()));
    }



}

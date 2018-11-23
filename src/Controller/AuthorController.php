<?php


namespace App\Controller;


use App\Entity\Author;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AuthorController
 * @package App\Controller
 * @Route("/author")
 */
class AuthorController extends BaseController
{
    /**
     * @Route("/new", name="author_new")
     */
    public function new(Request $request)
    {
        $author = new Author();

        $form = $this->createFormBuilder($author)
            ->add("firstname", TextType::class, array('label' => 'Prénom'))
            ->add("lastname", TextType::class, array('label' => 'Nom de famille'))
            ->add("save", SubmitType::class, array('label' => 'Créer un auteur'))
            ->getForm()
            ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($author);
            $em->flush();

            return $this->redirectToRoute("homepage");
        }


        return $this->render("author/new.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
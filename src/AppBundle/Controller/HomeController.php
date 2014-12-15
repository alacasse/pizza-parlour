<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity;
use AppBundle\Form;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $loginForm = $this->createForm(
            new Form\Type\Login(),
            null,
            array('action' => $this->generateUrl('login_check')
        ));

        return $this->render(
            'AppBundle:Home:home.html.twig',
            array(
                'form' => $loginForm->createView(),
            )
        );
    }

    /**
     * @Route("/login", name="login_check")
     */
    public function loginCheck(Request $request)
    {
        if ($request->getMethod() == Request::METHOD_POST) {
            return $this->redirect($this->generateUrl('order_page'));
        }
    }

    /**
     * @Route("/about", name="about")
     */
    public function infoAction()
    {
        return $this->render(
            'AppBundle:Home:about.html.twig'
        );
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        return $this->redirectToRoute('homepage');
    }

}

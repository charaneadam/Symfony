<?php

namespace OC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CoreController extends Controller
{
    public function indexAction(){
        return $this->render('OCCoreBundle::index.html.twig');
    }
    
    public function contacterNousAction(Request $request){
        $session = $request->getSession();
        $session->getFlashBag()->add('info', "La page de contact n'est pas encore disponible, merci de revenir plus tard");
        return $this->redirectToRoute('oc_core_homepage');
    }
}

<?php
namespace OC\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{

    public function indexAction($page){
        if($page < 1){
            throw new NotFoundHttpException("Page " . $page . " inexistante");
        }
        
        $listAdverts = array(
            array(
                'title'   => 'Recherche développpeur Symfony',
                'id'      => 1,
                'author'  => 'Alexandre',
                'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
                'date'    => new \Datetime()),
            array(
                'title'   => 'Mission de webmaster',
                'id'      => 2,
                'author'  => 'Hugo',
                'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
                'date'    => new \Datetime()),
            array(
                'title'   => 'Offre de stage webdesigner',
                'id'      => 3,
                'author'  => 'Mathieu',
                'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
                'date'    => new \Datetime())
        );
        
        //return $this->render('OCPlatformBundle:Advert:index.html.twig');
        return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }

    public function viewAction($id){
        $advert = array(
            'title'   => 'Recherche développpeur Symfony2',
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
            'date'    => new \Datetime()
        );
        
        return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
            'advert' => $advert
        ));
    }
    
    public function addAction(Request $request){
        $antispam = $this->container->get('oc_platform.antispam');
        $text = "...";
        if($antispam->isSpam($text)){
            throw new \Exception("Votre message a ete detecte comme spam");
        }
        if($request->isMethod('POST')){
            $request->getSession()->getFlashBag('notice', 'Annonce bien enregistrée.');
            return $this->redirectToRoute('oc_platform_view', array('id' => 5));
        }
        
        $advert = array(
            'title'   => 'Recherche développpeur Symfony2',
            'id'      => 5,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
            'date'    => new \Datetime()
        );
        
        return $this->render('OCPlatformBundle:Advert:add.html.twig', array(
            'advert' => $advert
        ));
    }
    
    public function editAction($id, Request $request){
        if($request->isMethod('POST')){
            $request->getSession()->getFlashBag('notice', 'Annonce bien modifiée.');
            return $this->redirectToRoute('oc_platform_view', array('id' => 5));
        }
        $advert = array(
            'title'   => 'Recherche développpeur Symfony2',
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
            'date'    => new \Datetime()
        );
        return $this->render('OCPlatformBundle:Advert:edit.html.twig', array(
            'advert' => $advert
        ));
    }
    
    public function deleteAction($id){
        return $this->render('OCPlatformBundle:Advert:delete.html.twig');
    }
    
    public function menuAction($limit){
        // On fixe en dur une liste ici, bien entendu par la suite
        // on la récupérera depuis la BDD !
        $listAdverts = array(
            array('id' => 2, 'title' => 'Recherche développeur Symfony'),
            array('id' => 5, 'title' => 'Mission de webmaster'),
            array('id' => 9, 'title' => 'Offre de stage webdesigner')
        );
        
        return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
            // Tout l'intérêt est ici : le contrôleur passe
            // les variables nécessaires au template !
            'listAdverts' => $listAdverts
        ));
    }
}
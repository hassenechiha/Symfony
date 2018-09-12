<?php

namespace MarsupilamiBundle\Controller;

use MarsupilamiBundle\Entity\User;
use MarsupilamiBundle\Form\UserForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class MarsupilamiController extends Controller
{
    public function accueilAction()
    {   $user = $this->container->get('security.token_storage')->getToken()->getUser();
        return $this->render('MarsupilamiBundle:Default:accueil.html.twig',array("user"=>$user));
    }
    public function affichageAction()
    {   $user = $this->container->get('security.token_storage')->getToken()->getUser();
        return $this->render('MarsupilamiBundle:Default:affichage.html.twig',array("user"=>$user));
    }
    public function updateAction(Request $request)
    {   $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $Form = $this->createForm(UserForm::class,$user);
        $Form->handleRequest($request);
        if ($Form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('info_Marsupilami');
        }
        return $this->render('MarsupilamiBundle:Default:update.html.twig',
            array('form'=>$Form->createView(),"user"=>$user));
}

    public function displayAction(){
      $userconnected1 = $this->container->get('security.token_storage')->getToken()->getUser()  ;
      $userconnected = $this->container->get('security.token_storage')->getToken()->getUser()->getId();
      $repository= $this->getDoctrine()->getRepository('MarsupilamiBundle:User');
      $query = $repository->createQueryBuilder('u')
          ->where('u.id != :identifier')
              ->setParameter('identifier', $userconnected)
          ->getQuery();
      $user = $query->getResult();




        return $this->render('MarsupilamiBundle:Default:ajoutamis.html.twig',array('u'=>$user,'u1'=>$userconnected1));
    }
    public function addfriendAction(Request $request,$id){
            $em=$em=$this->getDoctrine()->getManager();
            $user=$em->getRepository("MarsupilamiBundle:User")->find($id);
        $userconnected = $this->container->get('security.token_storage')->getToken()->getUser();
        $userconnected->addFriend($user);

            $em=$this->getDoctrine()->getManager();
            $em->persist($userconnected);
            $em->flush();
            return $this->redirectToRoute('info_Marsupilami');

        return $this->render('MarsupilamiBundle:Default:ajoutamis.html.twig',array('userc'=>$userconnected));

    }
    public function affichermescontactsAction(){
        $userconnected = $this->container->get('security.token_storage')->getToken()->getUser();
        return $this->render('MarsupilamiBundle:Default:showfriends.html.twig',array('u'=>$userconnected));

    }
    public function deletefriendAction(Request $request,$id){
        $em=$em=$this->getDoctrine()->getManager();
        $user=$em->getRepository("MarsupilamiBundle:User")->find($id);
        $userconnected = $this->container->get('security.token_storage')->getToken()->getUser();
        $userconnected->removeFriend($user);

        $em=$this->getDoctrine()->getManager();
        $em->persist($userconnected);
        $em->flush();
        return $this->redirectToRoute('info_Marsupilami');

        return $this->render('MarsupilamiBundle:Default:showfriends.html.twig',array('userc'=>$userconnected));

    }
}

<?php

namespace NewProjectBundle\Controller;

use NewProjectBundle\Entity\Upuser;
use NewProjectBundle\Entity\Phone;
use NewProjectBundle\Entity\Adress;
use NewProjectBundle\Entity\Email;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



class UpuserController extends Controller
{

    //all person in Contact Book
    /**
     * @Route("/allUsers2/")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function AllAction()
    {
        $em = $this->getDoctrine()->getManager();
        $userRep = $em->getRepository("NewProjectBundle:Upuser");
        $allUsers = $userRep->findAllOrderByName();
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');
        return $this->render('NewProjectBundle:Upuser:all.html.twig', ['allUsers' => $allUsers]);

    }


    //Personal information
    /**
     * @Route("/showUser/{id}/")
     *@Security("has_role('ROLE_ADMIN')")
     */
    public function showPersonAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $userRep = $em->getRepository("NewProjectBundle:Upuser");
        $user = $userRep->findOneById($id);

        $personAddress = $user->getAdress();
        $em=$this->getDoctrine()->getManager();
        $phoneRep = $em->getRepository("NewProjectBundle:Phone");
        $phoneAll= $phoneRep->findByUpuser($user);

        $em=$this->getDoctrine()->getManager();
        $emailRep = $em->getRepository('NewProjectBundle:Email');
        $emailAll= $emailRep->findByUpuser($user);
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');

        return $this->render('NewProjectBundle:Upuser:id.html.twig',
            ['user' => $user, 'adress' => $personAddress, 'phoneAll' => $phoneAll,
                'emailAll' => $emailAll]);
    }

    //Action- adding information about new person
    /**
     * @Route("/new/")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $user = new Upuser();
        $em = $this->getDoctrine()->getManager();
        $userRep = $em->getRepository("NewProjectBundle:Upuser");
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');
        $form = $this->userFormular($user, 'newproject_upuser_new');
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $user = $form->getData();
            $em->persist($user);
            $em->flush();
            $url = $this->generateUrl('newproject_upuser_all');
            return $this->redirect($url);
        }
        return $this->render('NewProjectBundle:Upuser:new.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("/{id}/addAdress")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addAdressAction(Request $request, $id)
    {
        $adress = new Adress();
        $em = $this->getDoctrine()->getManager();
        $form = $this->addressFormular($adress,'newproject_upuser_addadress', $id);
        $form->handleRequest($request);
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');
        if($form->isSubmitted() && $form->isValid()) {
            $adress = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($adress);
            $repository = $em->getRepository('NewProjectBundle:Upuser');
            $user = $repository->findOneById($id);
            $user->setAdress($adress);
            $em->persist($user);
            $em->flush();
            $url = $this->generateUrl('newproject_upuser_showperson', ['id' => $id]);
            return $this->redirect($url);
        }
        return $this->render('NewProjectBundle:Upuser:modifyAddress.html.twig', ['id' => $id,'form' => $form->createView()]);
    }


    /**
     * @Route("/{id}/addPhone")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addPhoneAction(Request $request, $id)
    {
        $phone = new Phone();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('NewProjectBundle:Upuser');
        $user = $repository->findOneById($id);
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');
        $form = $this->phoneFormular($phone,'newproject_upuser_addphone', $id);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $newPhone = $form->getData();
            $newPhone->setUpuser($user);
            $em->persist($newPhone);
            $em->flush();
            $url = $this->generateUrl('newproject_upuser_showperson', ['id' => $id]);
            return $this->redirect($url);
        }
        return $this->render('NewProjectBundle:Upuser:modifyPhone.html.twig', ['id' => $id,'form' => $form->createView()]);
    }


    /**
     * @Route("/{id}/addEmail")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addEmailAction(Request $request, $id)
    {
        $email = new Email();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('NewProjectBundle:Upuser');
        $user = $repository->findOneById($id);
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');
        $form = $this->emailFormular($email,'newproject_upuser_addemail', $id);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $newEmail = $form->getData();
            $newEmail->setUpuser($user);
            $em->persist($newEmail);
            $em->flush();
            $url = $this->generateUrl('newproject_upuser_showperson', ['id' => $id]);
            return $this->redirect($url);
        }
        return $this->render('NewProjectBundle:Upuser:modifyEmail.html.twig', ['id' => $id,'form' => $form->createView()]);
    }


    //Preediting person information
    /**
     * @Route("/{id}/modify/")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function modifyAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository("NewProjectBundle:Upuser");
        $user = $userRepository->findOneById($id);
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');
        if (!$user) {
            throw $this->createNotFoundException('No person found for id '.$id);
        }
        $form = $this->modifyUserFormular($user, 'newproject_upuser_modify', ['id'=>$id]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $em->persist($user);
            $em->flush();
            $url = $this->generateUrl( 'newproject_upuser_showperson', ['id' => $id]);
            return $this->redirect($url);
        }
        return $this->render('NewProjectBundle:Upuser:modify.html.twig', ['form' => $form->createView()]);

    }


    /**
     * @Route("/{id}/delete/")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction( $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository('NewProjectBundle:Upuser');
        $usersToDelete = $repository->findOneById($id);
        $entityManager->remove($usersToDelete);
        $entityManager->flush();
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');
        $url = $this->generateUrl('newproject_upuser_all');
        return $this->redirect($url);
    }


    /**
     * @Route("/{id}/deletePhone/{phoneId}")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deletePhoneAction($id, $phoneId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository('NewProjectBundle:Phone');
        $phoneToDelete = $repository->findOneById($phoneId);
        $entityManager->remove($phoneToDelete);
        $entityManager->flush();
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');
        $url = $this->generateUrl('newproject_upuser_showperson', ['id' => $id]);
        return $this->redirect($url);
    }


    /**
     * @Route("/{id}/delete/{emailId}")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteEmailAction($id, $emailId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository('NewProjectBundle:Email');
        $emailToDelete = $repository->findOneById($emailId);
        $entityManager->remove($emailToDelete);
        $entityManager->flush();
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');
        $url = $this->generateUrl('newproject_upuser_showperson', ['id' => $id]);
        return $this->redirect($url);
    }


    //forms
    protected function userFormular($user, $routeName, $slugs=[])
    {
        $form = $this->createFormBuilder($user)
            ->setAction($this->generateURL($routeName, $slugs))
            ->setMethod('POST')
            ->add('name', TextType::class, ['label' => 'Name'])
            ->add('surname', TextType::class, ['label' => 'Surname'])
            ->add('description', TextType::class, ['required' => false,'label' => 'Description'])
            ->add('save', SubmitType::class, ['label' => 'Create',
                'attr' => ['class' => 'btn btn-default pull-right']])
            ->getForm();
        return $form;
    }


    protected function addressFormular($address, $routeName, $id)
    {
        $form = $this->createFormBuilder($address)
            ->setAction($this->generateURL($routeName,  ['id' => $id]))
            ->setMethod('POST')
            ->add('city', TextType::class, ['label' => 'City'])
            ->add('street', TextType::class, ['label' => 'Street'])
            ->add('house', TextType::class, ['required' => false,'label' => 'House number'])
            ->add('flat', TextType::class, ['required' => false,'label' => 'Flat number'])
            ->add('save', SubmitType::class, ['label' => 'Create',
                'attr' => ['class' => 'btn btn-default pull-right']])
            ->getForm();
        return $form;
    }


    protected function modifyAddressFormular($id, $routeName,$address )
    {
        $form = $this->createFormBuilder($address)
            ->setAction($this->generateURL($routeName,  ['id' => $id]))
            ->setMethod('POST')
            ->add('city', TextType::class, ['label' => 'City'])
            ->add('street', TextType::class, ['label' => 'Street'])
            ->add('house', TextType::class, ['required' => false,'label' => 'House number'])
            ->add('flat', TextType::class, ['required' => false,'label' => 'Flat number'])
            ->add('save', SubmitType::class, ['label' => 'Edit',
                'attr' => ['class' => 'btn btn-default pull-right']])
            ->getForm();
        return $form;
    }


    protected function modifyUserFormular($user, $routeName, $slugs=[])
    {
        $form = $this->createFormBuilder($user)
            ->setAction($this->generateURL($routeName, $slugs))
            ->setMethod('POST')
            ->add('name', TextType::class, ['label' => 'Name'])
            ->add('surname', TextType::class, ['label' => 'Surname'])
            ->add('description', TextType::class, ['required' => false,'label' => 'Description'])
            ->add('save', SubmitType::class, ['label' => 'Edit',
                'attr' => ['class' => 'btn btn-default pull-right']])
            ->getForm();
        return $form;
    }


    protected function emailFormular($email, $routeName, $id)
    {
        $form = $this->createFormBuilder($email)
            ->setAction($this->generateURL($routeName,  ['id' => $id]))
            ->setMethod('POST')
            ->add('email', TextType::class, ['label' => 'Email'])
            ->add('type', TextType::class, ['required' => false,'label' => 'Type'])
            ->add('save',SubmitType::class, ['label' => 'Create',
                'attr' => ['class' => 'btn btn-default pull-right']])
            ->getForm();
        return $form;
    }


    protected function phoneFormular($phone, $routeName, $id)
    {
        $form = $this->createFormBuilder($phone)
            ->setAction($this->generateURL($routeName, ['id' => $id]))
            ->setMethod('POST')
            ->add('type', TextType::class, ['required' => false,'label' => 'Type'])
            ->add('number', TextType::class, ['label' => 'Number'])
            ->add('save', SubmitType::class, ['label' => 'Create',
                'attr' => ['class' => 'btn btn-default pull-right']])
            ->getForm();
        return $form;
    }



}

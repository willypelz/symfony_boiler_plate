<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Entity\User;
use App\Exception\NoCurrentUserException;
use App\Form\UserType;
use App\Security\UserResolver;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/api/user/change-password", methods={"POST"}, name="api_change_password_post")
 *
 * @View(statusCode=200, serializerGroups={"me"})
 *
 *  
 */
final class ChangeUserPasswordController extends Controller
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;


    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UserResolver
     */
    private $userResolver;

    /**
     * @param FormFactoryInterface   $formFactory
     * @param EntityManagerInterface $entityManager
     * @param UserResolver           $userResolver
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        UserResolver $userResolver
    ) {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->userResolver = $userResolver;
    }

    /**
     * @param Request $request
     *
     * @throws NoCurrentUserException
     *
     * @return array|FormInterface
     */
    public function __invoke(Request $request)
    {
      $user = new User();
      // $form = $this->createForm(ChangepasswordType::class, $user);
      // $form->handleRequest($request);

      // if ($form->isSubmitted() && $form->isValid()) {

      try {
        // $repository = $this->getDoctrine()->getRepository(Product::class);
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $request->request->get('email')]);

        dd($user->password);
        if(!$user){
            return 'user not found';
        } else{
            // $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

            // $newpassword = $this->passwordEncoder->encodePassword($user, $request->request->get('password')); 
            // $user->setPassword($newpassword);
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($user);
            // $em->flush();

        }

    } catch (ExceptionInterface $e) {
        return 'error';
    }

    // $newpassword = $passwordEncoder->encodePassword($user, $user->getPassword()); 
    // $oldpassword = $user->getPassword();

    // if ($newpassword = $oldpassword) {
    //     return 'please chose a new password';

    // } else {
    //     $user->setPassword($newpassword);
    // }

    // $em = $this->getDoctrine()->getManager();
    // $em->persist($user);
    // $em->flush();

    return 'password successfully updated';
        // $this->addFlash('success', 'votre mot de passe est bien  réinitialisé');

    // }
}
}

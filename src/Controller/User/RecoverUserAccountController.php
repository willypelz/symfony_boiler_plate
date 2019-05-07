<?php

declare(strict_types=1);

namespace App\Controller\User;

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


use Doctrine\ORM\Mapping as ORM;
use LazySec\Entity\ResetPasswordTrait;
use LazySec\Entity\UserTrait;
/**
 * @Route("/api/user/recover", methods={"POST"}, name="api_recover_post")
 *
 * @View(statusCode=200, serializerGroups={"me"})
 *
 *  
 */
final class RecoverUserAccountController
{
	use UserTrait;
	use ResetPasswordTrait;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

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
    	return $request->request->all();

    	// generateResetToken(DateInterval $interval);

    	// $user = $this->userResolver->getCurrentUser();

    	// $form = $this->formFactory->createNamed('user', UserType::class, $user);
    	// $form->submit($request->request->get('user'), false);

    	// if ($form->isValid()) {
    	// 	$this->entityManager->flush();

    	// 	return ['user' => $user];
    	// }

    	// return $form;
    }
}

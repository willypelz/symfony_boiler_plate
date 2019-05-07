<?php

declare(strict_types=1);

namespace App\Controller\Registration;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG; 
/**
 * @Route("/api/users", methods={"POST"}, name="api_users_post")
 *
 * @View(statusCode=201, serializerGroups={"me"})
 */
final class RegisterController
{

      /**
     * List the rewards of the specified user.
     *
     * This call takes into account all confirmed awards, but not pending or refused awards.
     *
     * @Route("/api/{user}/rewards", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns the rewards of an user",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Reward::class, groups={"full"}))
     *     )
     * )
     * @SWG\Parameter(
     *     name="order",
     *     in="query",
     *     type="string",
     *     description="The field used to order rewards"
     * )
     * @SWG\Tag(name="rewards")
     * @Security(name="Bearer")
     */
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
     * @param FormFactoryInterface         $factory
     * @param UserPasswordEncoderInterface $encoder
     * @param EntityManagerInterface       $manager
     */
    public function __construct(
        FormFactoryInterface $factory,
        UserPasswordEncoderInterface $encoder,
        EntityManagerInterface $manager
    ) {
        $this->formFactory = $factory;
        $this->passwordEncoder = $encoder;
        $this->entityManager = $manager;
    }

    /**
     * @param Request $request
     *
     * @return array|FormInterface
     */
    public function __invoke(Request $request)
    {
        $user = new User();

        $form = $this->formFactory->createNamed('user', UserType::class, $user);
        $form->submit($request->request->get('user'));

        if ($form->isValid()) {
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return ['user' => $user];
        }

        return $form;
    }
}

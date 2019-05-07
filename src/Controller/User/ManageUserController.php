<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Entity\User;
use App\Exception\NoCurrentUserException;
use App\Form\UserType;
use App\Security\UserResolver;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\View;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG; 

  /**
     * List the rewards of the specified user.
     *
     * This call takes into account all confirmed awards, but not pending or refused awards.
     *
     * @Route("/api/rewards", methods={"POST"})
     * @SWG\Post(
     *   path="/api/rewards",
     *   summary="Casting your vote for the right person API.",
     *   tags={"Vote"},
     *   description="",
     *   operationId="vote",
     *   @SWG\Parameter(
     *     name="user_id",
     *     in="formData",
     *     description="User ID.",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="contestant_id",
     *     in="formData",
     *     description="Contestant ID.",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="position_id",
     *     in="formData",
     *     description="Position ID .",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     * @SWG\Response(response=406, description="not acceptable"),
     * @SWG\Response(response=500, description="internal server error")
     * ),
     * )
     *
     */
  final class ManageUserController extends Controller
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
        // return 'hello';
        return $request->request->get();


    }
}

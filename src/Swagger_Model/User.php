<?php declare(strict_types=1);

namespace App\Swagger_Model;

use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

class User
{
    /**
    * @var int
    * @SWG\Property(description="The unique identifier of the user.")
    */
    public $id;

    /**
    * @SWG\Property(type="string", maxLength=255)
    */
    public $username;

    /**
    * @SWG\Property(ref=@Model(type=User::class))
    */
    public $friend;
}
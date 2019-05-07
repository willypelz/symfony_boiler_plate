<?php
namespace App\Swagger_Model\Api_Response;
/**
* @license Apache 2.0
*/ 
/**
* Class ApiResponse
*
* @package Petstore30
*
* @author  Donii Sergii <doniysa@gmail.com>
*
* @OA\Schema(
*     description="Api response",
*     title="Api response"
* )
*/
class Api_Response
{
    /**
    * @OA\Property(
    *     description="Code",
    *     title="Code",
    *     format="int32"
    * )
    *
    * @var int
    */
    private $code;
    /**
    * OA\Property(
    *    description="Type",
    *    title="Type",
    * )
    *
    * @var string
    */
    private $type;
    /**
    * @OA\Property(
    *     description="Message",
    *     title="Message"
    * )
    *
    * @var string
    */
    private $message;
}
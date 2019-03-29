<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/28/19
 * Time: 1:21 AM
 */

namespace CoreBundle\Controller;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * @RouteResource("login", pluralize=false)
 */
class SecurityController extends AbstractFOSRestController implements ClassResourceInterface
{
    public function postAction()
    {
        // route handled by Lexik JWT Authentication Bundle
        throw new \DomainException('You should never see this');
    }
}
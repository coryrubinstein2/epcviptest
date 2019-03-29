<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/27/19
 * Time: 9:56 AM
 */

namespace ApiBundle\Listener;
use ApiBundle\Entity\ApiRequests;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;

class ApiRequestListener
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    public function setEntityManager(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onControllerResponse(PostResponseEvent $event)
    {
        $this->logger->info(
            'API Request URI: '.$event->getRequest()->getRequestUri().
            'API Request Content: '.$event->getRequest()->getContent().
            'API Request Status Code: '.$event->getResponse()->getStatusCode().
            'API Response Content: '.$event->getResponse()->getContent()
        );

        $apiRequest = new ApiRequests();
        $apiRequest->setRequestUri($event->getRequest()->getRequestUri());
        $apiRequest->setRequestContent($event->getRequest()->getContent());
        $apiRequest->setResponseStatusCode($event->getResponse()->getStatusCode());
        $apiRequest->setResponseContent($event->getResponse()->getContent());

        try {
            $this->entityManager->persist($apiRequest);
            $this->entityManager->flush();

        } catch(\Exception $ex) {

        }
    }
}
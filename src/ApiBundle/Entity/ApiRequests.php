<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/27/19
 * Time: 8:36 AM
 */

namespace ApiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="API_Logs")
 * @ORM\Entity()
 */
class ApiRequests
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(name="requestContent", type="string", length=255)
     */
    private $requestContent;

    /**
     * @ORM\Column(name="requestUri", type="string", length=255)
     */
    private $requestUri;

    /**
     * @ORM\Column(name="responseContent", type="string", length=255)
     */
    private $responseContent;

    /**
     * @ORM\Column(name="responseStatusCode", type="integer", length=255)
     */
    private $responseStatusCode;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     * @return ApiRequests
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequestContent()
    {
        return $this->requestContent;
    }

    /**
     * @param mixed $requestContent
     * @return ApiRequests
     */
    public function setRequestContent($requestContent)
    {
        $this->requestContent = $requestContent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * @param mixed $requestUri
     * @return ApiRequests
     */
    public function setRequestUri($requestUri)
    {
        $this->requestUri = $requestUri;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponseContent()
    {
        return $this->responseContent;
    }

    /**
     * @param mixed $responseContent
     * @return ApiRequests
     */
    public function setResponseContent($responseContent)
    {
        $this->responseContent = $responseContent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponseStatusCode()
    {
        return $this->responseStatusCode;
    }

    /**
     * @param mixed $responseStatusCode
     * @return ApiRequests
     */
    public function setResponseStatusCode($responseStatusCode)
    {
        $this->responseStatusCode = $responseStatusCode;
        return $this;
    }
}
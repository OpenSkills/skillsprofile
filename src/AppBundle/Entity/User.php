<?php
namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as FOSUBUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class User extends FOSUBUser
{
    /**
     * @ORM\Column(name="id", type="string", length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\Column(name="linkedin_id", type="string", length=255, nullable=true)
     */
    private $linkedinId;

    /**
     * @ORM\Column(name="linkedin_access_token", type="string", length=255, nullable=true)
     */
    private $linkedinAccessToken;

    /**
     * @ORM\Column(name="companyId", type="string", length=255, nullable=true)
     */
    private $companyId;

    /**
     * @ORM\Column(name="picture_url", type="string", length=255, nullable=true)
     */
    private $pictureUrl;

    /**
     * @ORM\Column(name="location", type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLinkedinId()
    {
        return $this->linkedinId;
    }

    /**
     * @param mixed $linkedinId
     */
    public function setLinkedinId($linkedinId)
    {
        $this->linkedinId = $linkedinId;
    }

    /**
     * @return mixed
     */
    public function getLinkedinAccessToken()
    {
        return $this->linkedinAccessToken;
    }

    /**
     * @param mixed $linkedinAccessToken
     */
    public function setLinkedinAccessToken($linkedinAccessToken)
    {
        $this->linkedinAccessToken = $linkedinAccessToken;
    }

    /**
     * @return mixed
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @param mixed $companyId
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;
    }

    /**
     * @return mixed
     */
    public function getPictureUrl()
    {
        return $this->pictureUrl;
    }

    /**
     * @param mixed $pictureUrl
     */
    public function setPictureUrl($pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }
}

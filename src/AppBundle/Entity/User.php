<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as FOSUBUser;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A User of the platform.
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 * @UniqueEntity(fields={"email"}, groups={"user_validate"})
 * @UniqueEntity(fields={"username"}, groups={"user_validate"})
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
     * @Groups({"user_read, user_write"})
     */
    private $pictureUrl;

    /**
     * @ORM\Column(name="location", type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * The username of the author.
     *
     * @var string
     *
     * @Groups({"user_read"})
     * @Assert\NotBlank(groups={"user_validate"})
     * @Assert\Email(groups={"user_validate"})
     * @Assert\Expression(
     *     "this.getEmail() === this.getUsername()",
     *     message="Username should be equal to email",
     *     groups={"user_validate"}
     * )
     */
    protected $username;

    /**
     * The email of the user.
     *
     * @var string
     *
     * @Groups({"user_read", "user_write"})
     * @Assert\NotBlank(groups={"user_validate"})
     * @Assert\Email(groups={"user_validate"})
     */
    protected $email;

    /**
     * @var ArrayCollection<UserSkill>.
     *
     * @ORM\OneToMany(targetEntity="UserSkill", mappedBy="user", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Groups({"user_read", "user_write"})
     */
    private $userSkills;

    public function __construct()
    {
        parent::__construct();
        $this->userSkills = new ArrayCollection();
    }

    /**
     * @return string
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

    /**
     * @return ArrayCollection
     */
    public function getSkills()
    {
        return $this->userSkills;
    }

    /**
     * @param ArrayCollection $skills
     */
    public function setSkills($skills)
    {
        $this->userSkills = $skills;
    }

    /**
     * @param UserSkill $skill
     */
    public function addSkill(UserSkill $userSkill)
    {
        $this->userSkills->add($userSkill);
    }

    public function removeUserSkill(UserSkill $userSkill)
    {
        $this->userSkills->remove($userSkill);
    }
}

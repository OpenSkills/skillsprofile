<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A skill related to a user with his level of mastery.
 *
 * @ORM\Entity
 */
class UserSkill
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string Id of the skill from the http://skillsapi.xyz/ API
     *
     * @ORM\Column(type="string")
     * @Assert\Type(type="string")
     */
    private $skillId;

    /**
     * @var string Copy of the skill title from the http://skillsapi.xyz/ API
     *
     * @ORM\Column(type="string")
     * @Assert\Type(type="string")
     */
    private $skillTitle;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Assert\Type(type="integer")
     */
    private $level;


    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userSkills")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSkillId()
    {
        return $this->skillId;
    }

    /**
     * @param string $skillId
     */
    public function setSkillId($skillId)
    {
        $this->skillId = $skillId;
    }

    /**
     * @return string
     */
    public function getSkillTitle()
    {
        return $this->skillTitle;
    }

    /**
     * @param string $skillTitle
     */
    public function setSkillTitle($skillTitle)
    {
        $this->skillTitle = $skillTitle;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }
}

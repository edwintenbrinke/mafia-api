<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CooldownRepository")
 */
class Cooldown
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="cooldown", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"public"})
     */
    private $crime;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"public"})
     */
    private $organized_crime;

    public function __construct()
    {
        $this->crime = new DateTime();
        $this->organized_crime = new DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCrime(): DateTime
    {
        return $this->crime;
    }

    public function setCrime(DateTime $crime): self
    {
        $this->crime = $crime;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getOrganizedCrime(): ?\DateTime
    {
        return $this->organized_crime;
    }

    public function setOrganizedCrime(\DateTime $organized_crime): self
    {
        $this->organized_crime = $organized_crime;

        return $this;
    }
}

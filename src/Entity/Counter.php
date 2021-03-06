<?php

namespace App\Entity;

use App\Entity\Traits\DatetimeInfoTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="App\Repository\CounterRepository")
 */
class Counter
{
    use DatetimeInfoTrait;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="counter", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"public"})
     */
    private $crime = 0;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"public"})
     */
    private $organized_crime = 0;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"public"})
     */
    private $grand_theft_auto = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCrime(): ?int
    {
        return $this->crime;
    }

    public function setCrime(int $crime): self
    {
        $this->crime = $crime;

        return $this;
    }

    public function addCrime(): self
    {
        $this->crime += 1;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getOrganizedCrime(): ?int
    {
        return $this->organized_crime;
    }

    public function setOrganizedCrime(int $organized_crime): self
    {
        $this->organized_crime = $organized_crime;

        return $this;
    }

    public function addOrganizedCrime(): self
    {
        $this->organized_crime += 1;

        return $this;
    }

    public function getGrandTheftAuto(): ?int
    {
        return $this->grand_theft_auto;
    }

    public function setGrandTheftAuto(int $grand_theft_auto): self
    {
        $this->grand_theft_auto = $grand_theft_auto;

        return $this;
    }

    public function addGrandTheftAuto(): self
    {
        $this->grand_theft_auto += 1;

        return $this;
    }
}

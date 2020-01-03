<?php

namespace App\Entity;

use App\Entity\Traits\DatetimeInfoTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    use DatetimeInfoTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"public"})
     */
    private $experience;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"public"})
     */
    private $cash;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"public"})
     */
    private $bank;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Counter", mappedBy="user", cascade={"persist", "remove"})
     * @Groups({"public"})
     */
    private $counter;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Cooldown", mappedBy="user", cascade={"persist", "remove"})
     * @Groups({"public"})
     */
    private $cooldown;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Garage", mappedBy="user", cascade={"persist", "remove"})
     */
    private $garage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExperience(): int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function addExperience(int $experience): self
    {
        $this->experience += $experience;

        return $this;
    }

    public function getCash(): ?int
    {
        return $this->cash;
    }

    public function setCash(int $cash): self
    {
        $this->cash = $cash;

        return $this;
    }

    public function addCash(int $amount): self
    {
        $this->cash += $amount;

        return $this;
    }

    public function getBank(): ?int
    {
        return $this->bank;
    }

    public function setBank(int $bank): self
    {
        $this->bank = $bank;

        return $this;
    }

    public function getCounter(): ?Counter
    {
        return $this->counter;
    }

    public function setCounter(Counter $counter): self
    {
        $this->counter = $counter;

        // set the owning side of the relation if necessary
        if ($counter->getUser() !== $this) {
            $counter->setUser($this);
        }

        return $this;
    }

    public function getCooldown(): ?Cooldown
    {
        return $this->cooldown;
    }

    public function setCooldown(?Cooldown $cooldown): self
    {
        $this->cooldown = $cooldown;

        // set (or unset) the owning side of the relation if necessary
        $newUser = null === $cooldown ? null : $this;
        if ($cooldown->getUser() !== $newUser) {
            $cooldown->setUser($newUser);
        }

        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(Garage $garage): self
    {
        $this->garage = $garage;

        // set the owning side of the relation if necessary
        if ($garage->getUser() !== $this) {
            $garage->setUser($this);
        }

        return $this;
    }
}

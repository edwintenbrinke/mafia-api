<?php

namespace App\Entity;

use App\Entity\Traits\DatetimeInfoTrait;
use App\Helper\Random;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
{
    use DatetimeInfoTrait;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"public"})
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"public"})
     */
    private $damage;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public"})
     */
    private $image_path;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Garage", inversedBy="cars")
     */
    private $garage;

    public function __construct(string $name, string $image_path, int $price, int $damage)
    {
        $this->name = $name;
        $this->image_path = $image_path;
        $this->price = $price;
        $this->damage = $damage;
    }

    /**
     * @param $json
     *
     * @return Car
     * @throws \Exception
     */
    public static function createFromJson($json)
    {
        return new self(
            $json->name,
            $json->image_path,
            $json->price,
            Random::chance(0,99)
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDamage(): ?int
    {
        return $this->damage;
    }

    public function setDamage(int $damage): self
    {
        $this->damage = $damage;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->image_path;
    }

    public function setImagePath(string $image_path): self
    {
        $this->image_path = $image_path;

        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): self
    {
        $this->garage = $garage;

        return $this;
    }
}

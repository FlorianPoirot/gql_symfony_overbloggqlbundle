<?php

namespace App\Entity;

use App\Repository\PlanetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanetRepository::class)
 */
class Planet
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id = 0;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $name = "";

    /**
     * @var Collection|Astronaut[]
     *
     * @ORM\ManyToMany(targetEntity=Astronaut::class)
     * @ORM\JoinTable(name="planet_astronaut",
     *      joinColumns={@ORM\JoinColumn(name="planet_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="astronaut_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private Collection $astronauts;

    public function __construct()
    {
        $this->astronauts = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Collection|Astronaut[]
     */
    public function getAstronauts()
    {
        return $this->astronauts;
    }

    /**
     * @param Collection $astronauts
     * @return $this
     */
    public function setAstronauts(Collection $astronauts): self
    {
        $this->astronauts = $astronauts;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
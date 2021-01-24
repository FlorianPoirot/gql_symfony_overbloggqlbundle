<?php

namespace App\Entity;

use App\Repository\AstronautRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AstronautRepository::class)
 */
class Astronaut
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
    private string $pseudo = "";

    /**
     * @ORM\ManyToOne(targetEntity="Grade")
     * @ORM\JoinColumn(name="grade_id", referencedColumnName="id")
     */
    private Grade $grade;


    public function getId(): int
    {
        return $this->id;
    }

    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @param Grade $grade
     * @return $this
     */
    public function setGrade(Grade $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     * @return $this
     */
    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }
}

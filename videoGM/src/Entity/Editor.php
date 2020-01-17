<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EditorRepository")
 */
class Editor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $societyName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nationality;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\VideoGame", inversedBy="editor")
     * @ORM\JoinColumn(nullable=false)
     */
    private $videoGame;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSocietyName(): ?string
    {
        return $this->societyName;
    }

    public function setSocietyName(string $societyName): self
    {
        $this->societyName = $societyName;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getVideoGame(): ?VideoGame
    {
        return $this->videoGame;
    }

    public function setVideoGame(?VideoGame $videoGame): self
    {
        $this->videoGame = $videoGame;

        return $this;
    }
}

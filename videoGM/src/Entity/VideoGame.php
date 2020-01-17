<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VideoGameRepository")
 */
class VideoGame
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $support;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $releaseDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\editor", mappedBy="videoGame", orphanRemoval=true)
     */
    private $editor;

    public function __construct()
    {
        $this->editor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSupport(): ?string
    {
        return $this->support;
    }

    public function setSupport(string $support): self
    {
        $this->support = $support;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getReleaseDate(): ?int
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(int $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * @return Collection|editor[]
     */
    public function getEditor(): Collection
    {
        return $this->editor;
    }

    public function addEditor(editor $editor): self
    {
        if (!$this->editor->contains($editor)) {
            $this->editor[] = $editor;
            $editor->setVideoGame($this);
        }

        return $this;
    }

    public function removeEditor(editor $editor): self
    {
        if ($this->editor->contains($editor)) {
            $this->editor->removeElement($editor);
            // set the owning side to null (unless already changed)
            if ($editor->getVideoGame() === $this) {
                $editor->setVideoGame(null);
            }
        }

        return $this;
    }
}

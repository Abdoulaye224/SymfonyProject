<?php

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Type(type="DateTime")
     */
    private $releaseDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Editor", inversedBy="videoGame")
     * @ORM\JoinColumn(nullable=true)
     */
    private $editor;


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

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }


    public function getEditor(): ?Editor
    {
        return $this->editor;
    }

    public function setEditor(?Editor $editor): self
    {
        $this->editor = $editor;

        return $this;
    }
   //public function addEditor(editor $editor): self
   //{
   //    if (!$this->editor->contains($editor)) {
   //        $this->editor[] = $editor;
   //        $editor->setVideoGame($this);
   //    }

   //    return $this;
   //}

   //public function removeEditor(editor $editor): self
   //{
   //    if ($this->editor->contains($editor)) {
   //        $this->editor->removeElement($editor);
   //        // set the owning side to null (unless already changed)
   //        if ($editor->getVideoGame() === $this) {
   //            $editor->setVideoGame(null);
   //        }
   //    }

   //    return $this;
   //}
}

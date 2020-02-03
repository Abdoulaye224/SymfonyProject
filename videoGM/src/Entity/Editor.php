<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


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
     * @ORM\Column(type="string", length=50)
     *  @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Le nom de la société ne peut être un numbre"
     * )
     *  @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom de la société doit être d'au moins {{ limit }} caractères",
     * )
     */
    private $societyName;

    /**
     * @ORM\Column(type="string", length=100)
     *  @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Ce champ ne peut être un nombre"
     * )
     *  @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "La nationalité doit être d'au moins {{ limit }} caractères",
     * )
     */
    private $nationality;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VideoGame", mappedBy="editor")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $videoGame;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Le nom ne peut pas être vide")
     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$"
     * )
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom doit être d'au moins {{ limit }} caractères",
     * )
     */
    private $name;

    public function __construct()
    {
        $this->videoGame = new ArrayCollection();
    }

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

    /**
     * @return Collection|VideoGame[]
     */
    public function getVideoGame(): Collection
    {
        return $this->videoGame;
    }

    public function setVideoGame(VideoGame $videoGame){
        if(!$this->videoGame->contains($videoGame)){
            $this->videoGame[] = $videoGame;
            $videoGame->setEditor($this);
        }
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
}

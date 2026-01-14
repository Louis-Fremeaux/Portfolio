<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $text = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $GithubLink = null;

    /**
     * @var Collection<int, Paragraphe>
     */
    #[ORM\OneToMany(targetEntity: Paragraphe::class, mappedBy: 'id_project')]
    private Collection $paragraphes;

    public function __construct()
    {
        $this->paragraphes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getGithubLink(): ?string
    {
        return $this->GithubLink;
    }

    public function setGithubLink(?string $GithubLink): static
    {
        $this->GithubLink = $GithubLink;

        return $this;
    }

    /**
     * @return Collection<int, Paragraphe>
     */
    public function getParagraphes(): Collection
    {
        return $this->paragraphes;
    }

    public function addParagraphe(Paragraphe $paragraphe): static
    {
        if (!$this->paragraphes->contains($paragraphe)) {
            $this->paragraphes->add($paragraphe);
            $paragraphe->setIdProject($this);
        }

        return $this;
    }

    public function removeParagraphe(Paragraphe $paragraphe): static
    {
        if ($this->paragraphes->removeElement($paragraphe)) {
            // set the owning side to null (unless already changed)
            if ($paragraphe->getIdProject() === $this) {
                $paragraphe->setIdProject(null);
            }
        }

        return $this;
    }
}

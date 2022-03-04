<?php

namespace App\Entity;

use App\Repository\ArticleBisEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleBisEntityRepository::class)]
class ArticleBisEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\NoBlank("Le titre ne peut être vide!")]
    private ?string $title;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $content;

    #[ORM\Column(type: 'date')]
    #[Assert\NotNull(message: "La date de la publication ne peut êrtre nul")]
    private \DateTime $dateAdd;

    #[ORM\Column(type: 'boolean')]
    #[Assert\IsTrue(message: "Les conditions générales doivent être acceptées")]
    private ?bool $isPublished;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'articles')]
    private $user;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?bool $cover;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     */
    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getDateAdd(): \DateTime
    {
        return $this->dateAdd;
    }

    /**
     * @param \DateTime $dateAdd
     */
    public function setDateAdd(\DateTime $dateAdd): void
    {
        $this->dateAdd = $dateAdd;
    }

    /**
     * @return bool|null
     */
    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    /**
     * @param bool|null $isPublished
     */
    public function setIsPublished(?bool $isPublished): void
    {
        $this->isPublished = $isPublished;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return bool|null
     */
    public function getCover(): ?bool
    {
        return $this->cover;
    }

    /**
     * @param bool|null $cover
     */
    public function setCover(?bool $cover): void
    {
        $this->cover = $cover;
    }

}

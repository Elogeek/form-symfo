<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $title;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $content;

    #[ORM\Column(type: 'date')]
    private \DateTime $dateAdd;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isPublished;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'articles')]
    private $user;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?bool $token;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?bool $fileCover;

    public function getId(): ?int {
        return $this->id;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(string $title): self {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string {
        return $this->content;
    }

    public function setContent(string $content): self {
        $this->content = $content;

        return $this;
    }

    public function getDateAdd(): ?\DateTimeInterface {
        return $this->dateAdd;
    }

    public function setDateAdd(\DateTimeInterface $dateAdd): self {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsPublished(): ?bool {
        return $this->isPublished;
    }

    /**
     * @param bool|null $isPublished
     */
    public function setIsPublished(?bool $isPublished): void {
        $this->isPublished = $isPublished;
    }

    /**
     * @return mixed
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void {
        $this->user = $user;
    }

    /**
     * @return bool|null
     */
    public function getToken(): ?bool {
        return $this->token;
    }

    /**
     * @param bool|null $token
     */
    public function setToken(?bool $token): void {
        $this->token = $token;
    }

    /**
     * @return bool|null
     */
    public function getFileCover(): ?bool {
        return $this->fileCover;
    }

    /**
     * @param bool|null $fileCover
     */
    public function setFileCover(?bool $fileCover): void {
        $this->fileCover = $fileCover;
    }

}

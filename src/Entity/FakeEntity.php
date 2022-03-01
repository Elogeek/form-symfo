<?php

namespace App\Entity;

use App\Repository\FakeEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FakeEntityRepository::class)]
/**
 * Class for tests fields form
 */
class FakeEntity {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * Test for textType
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    /**
     * Test for emailType
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    /**
     * Test for textareaType
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $sign;

    /**
     * Test for integerType
     */
    #[ORM\Column(type: 'integer')]
    private $age;

    /**
     * Test for moneyType
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $currency;

    /**
     * Test for numberType
     */
    #[ORM\Column(type: 'float')]
    private $price;

    /**
     * Test for passwordType
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    /**
     * Test for urlType
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $url;

    /**
     * Test for rangeType
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $userRange;

    /**
     * Test for telType
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $phone;

    /**
     * Test for colorType
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $color;

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = $email;

        return $this;
    }

    public function getSign(): ?string {
        return $this->sign;
    }

    public function setSign(string $sign): self {
        $this->sign = $sign;

        return $this;
    }

    public function getAge(): ?int {
        return $this->age;
    }

    public function setAge(int $age): self {
        $this->age = $age;

        return $this;
    }

    public function getCurrency(): ?string {
        return $this->currency;
    }

    public function setCurrency(string $currency): self {
        $this->currency = $currency;

        return $this;
    }

    public function getPrice(): ?float {
        return $this->price;
    }

    public function setPrice(float $price): self {
        $this->price = $price;

        return $this;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword(string $password): self {
        $this->password = $password;

        return $this;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function setUrl(string $url): self {
        $this->url = $url;

        return $this;
    }

    public function getUserRange(): ?string {
        return $this->userRange;
    }

    public function setUserRange(string $userRange): self {
        $this->userRange = $userRange;

        return $this;
    }

    public function getPhone(): ?string {
        return $this->phone;
    }

    public function setPhone(string $phone): self {
        $this->phone = $phone;

        return $this;
    }

    public function getColor(): ?string {
        return $this->color;
    }

    public function setColor(string $color): self {
        $this->color = $color;

        return $this;
    }

}

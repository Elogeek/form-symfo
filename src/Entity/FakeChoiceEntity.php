<?php

namespace App\Entity;

use App\Repository\FakeChoiceEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FakeChoiceEntityRepository::class)]
class FakeChoiceEntity {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $choiceString;

    #[ORM\Column(type: 'integer')]
    private $choiceInt;

    #[ORM\Column(type: 'boolean')]
    private $choiceBool;

    #[ORM\Column(type: 'string', length: 255)]
    private $country;

    #[ORM\Column(type: 'string', length: 255)]
    private $language;

    #[ORM\Column(type: 'string', length: 255)]
    private $money;

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getChoiceString(): ?string {
        return $this->choiceString;
    }

    /**
     * @param string $choiceString
     * @return $this
     */
    public function setChoiceString(string $choiceString): self {
        $this->choiceString = $choiceString;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getChoiceInt(): ?int {
        return $this->choiceInt;
    }

    /**
     * @param int $choiceInt
     * @return $this
     */
    public function setChoiceInt(int $choiceInt): self {
        $this->choiceInt = $choiceInt;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getChoiceBool(): ?bool {
        return $this->choiceBool;
    }

    /**
     * @param bool $choiceBool
     * @return $this
     */
    public function setChoiceBool(bool $choiceBool): self {
        $this->choiceBool = $choiceBool;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void {
        $this->country = $country;
    }
    /**
     * @return mixed
     */
    public function getLanguage() {
       return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language): void {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getMoney() {
        return $this->money;
    }

    /**
     * @param mixed $money
     */
    public function setMoney($money): void {
        $this->money = $money;
    }

}

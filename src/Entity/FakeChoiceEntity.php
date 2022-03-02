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

    public function getId(): ?int {
        return $this->id;
    }

    public function getChoiceString(): ?string {
        return $this->choiceString;
    }

    public function setChoiceString(string $choiceString): self {
        $this->choiceString = $choiceString;

        return $this;
    }

    public function getChoiceInt(): ?int {
        return $this->choiceInt;
    }

    public function setChoiceInt(int $choiceInt): self {
        $this->choiceInt = $choiceInt;

        return $this;
    }

    public function getChoiceBool(): ?bool {
        return $this->choiceBool;
    }

    public function setChoiceBool(bool $choiceBool): self {
        $this->choiceBool = $choiceBool;

        return $this;
    }

}

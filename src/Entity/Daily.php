<?php

namespace App\Entity;

use App\Repository\DailyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DailyRepository::class)
 */
class Daily
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="dailies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $breackfast;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $lunch1;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $lunch2;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $dessert;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $snack;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $bottle;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $diaper;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $nap;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $message;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $absence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getBreackfast(): ?string
    {
        return $this->breackfast;
    }

    public function setBreackfast(?string $breackfast): self
    {
        $this->breackfast = $breackfast;

        return $this;
    }

    public function getLunch1(): ?string
    {
        return $this->lunch1;
    }

    public function setLunch1(?string $lunch1): self
    {
        $this->lunch1 = $lunch1;

        return $this;
    }

    public function getLunch2(): ?string
    {
        return $this->lunch2;
    }

    public function setLunch2(?string $lunch2): self
    {
        $this->lunch2 = $lunch2;

        return $this;
    }

    public function getDessert(): ?string
    {
        return $this->dessert;
    }

    public function setDessert(?string $dessert): self
    {
        $this->dessert = $dessert;

        return $this;
    }

    public function getSnack(): ?string
    {
        return $this->snack;
    }

    public function setSnack(?string $snack): self
    {
        $this->snack = $snack;

        return $this;
    }

    public function getBottle(): ?string
    {
        return $this->bottle;
    }

    public function setBottle(?string $bottle): self
    {
        $this->bottle = $bottle;

        return $this;
    }

    public function getDiaper(): ?string
    {
        return $this->diaper;
    }

    public function setDiaper(?string $diaper): self
    {
        $this->diaper = $diaper;

        return $this;
    }

    public function getNap(): ?string
    {
        return $this->nap;
    }

    public function setNap(?string $nap): self
    {
        $this->nap = $nap;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAbsence(): ?string
    {
        return $this->absence;
    }

    public function setAbsence(?string $absence): self
    {
        $this->absence = $absence;

        return $this;
    }
}

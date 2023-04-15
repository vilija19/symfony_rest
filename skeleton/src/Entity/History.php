<?php

namespace App\Entity;

use App\Repository\HistoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoryRepository::class)
 */
class History
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $firstIn;

    /**
     * @ORM\Column(type="integer")
     */
    private $secondIn;

    /**
     * @ORM\Column(type="integer")
     */
    private $firstOut;

    /**
     * @ORM\Column(type="integer")
     */
    private $secondOut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $update_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstIn(): ?int
    {
        return $this->firstIn;
    }

    public function setFirstIn(int $firstIn): self
    {
        $this->firstIn = $firstIn;

        return $this;
    }

    public function getSecondIn(): ?int
    {
        return $this->secondIn;
    }

    public function setSecondIn(int $secondIn): self
    {
        $this->secondIn = $secondIn;

        return $this;
    }

    public function getFirstOut(): ?int
    {
        return $this->firstOut;
    }

    public function setFirstOut(int $firstOut): self
    {
        $this->firstOut = $firstOut;

        return $this;
    }

    public function getSecondOut(): ?int
    {
        return $this->secondOut;
    }

    public function setSecondOut(int $secondOut): self
    {
        $this->secondOut = $secondOut;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->update_date;
    }

    public function setUpdateDate(\DateTimeInterface $update_date): self
    {
        $this->update_date = $update_date;

        return $this;
    }
}

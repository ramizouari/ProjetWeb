<?php

namespace App\Entity;

use App\Repository\ExchangeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExchangeRepository::class)
 */
class Exchange
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $requesterId;

    /**
     * @ORM\Column(type="integer")
     */
    private $responderId;

    /**
     * @ORM\Column(type="integer")
     */
    private $state;

    /**
     * @ORM\Column(type="datetime")
     */
    private $requestDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $requestedBookId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $respondedBookId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRequesterId(): ?int
    {
        return $this->requesterId;
    }

    public function setRequesterId(int $requesterId): self
    {
        $this->requesterId = $requesterId;

        return $this;
    }

    public function getResponderId(): ?int
    {
        return $this->responderId;
    }

    public function setResponderId(int $responderId): self
    {
        $this->responderId = $responderId;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(int $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getRequestDate(): ?\DateTimeInterface
    {
        return $this->requestDate;
    }

    public function setRequestDate(\DateTimeInterface $requestDate): self
    {$this->requestDate = $requestDate;
        return $this;}

    public function getRequestedBookId(): ?int
    {return $this->requestedBookId;}

    public function setRequestedBookId(int $requestedBookId): self
    {
        $this->requestedBookId = $requestedBookId;
        return $this;
    }

    public function getRespondedBookId(): ?int
    {
        return $this->respondedBookId;
    }

    public function setRespondedBookId(?int $respondedBookId): self
    {
        $this->respondedBookId = $respondedBookId;

        return $this;
    }
}

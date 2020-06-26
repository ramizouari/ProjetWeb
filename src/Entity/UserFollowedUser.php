<?php

namespace App\Entity;

use App\Repository\UserFollowedUserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserFollowedUserRepository::class)
 */
class UserFollowedUser
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
    private $followerId;

    /**
     * @ORM\Column(type="integer")
     */
    private $followedId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFollowerId(): ?int
    {
        return $this->followerId;
    }

    public function setFollowerId(int $followerId): self
    {
        $this->followerId = $followerId;

        return $this;
    }

    public function getFollowedId(): ?int
    {
        return $this->followedId;
    }

    public function setFollowedId(int $followedId): self
    {
        $this->followedId = $followedId;

        return $this;
    }
}

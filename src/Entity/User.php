<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;
       /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;
     /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $lastName;
    

    /**
     * @var string The hashed passwordHash
     * @ORM\Column(type="string")
     */
    private $passwordHash;

     /**
     * @ORM\ManyToMany(targetEntity=Book::class, inversedBy="users")
     */
    private $booksCollection;
      /**
     * @ORM\ManyToMany(targetEntity=Book::class)
     */
    private $followedBooks;

        /**
    * @ORM\Column(type="integer")
    */
    private $phoneNumber;

    /**
    * @ORM\Column(type="json")
    */
    private $roles = [];

    
    private $plainPassword;
    private $rememberSession;

  //  /**
  //   * @ORM\Column(type="string", length=255, nullable=true)
  //   */
    private $photoPath;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }


    public function hasRoles($ch): bool
    {
        $roles =  $this->getRoles() ;

       return in_array($ch,$roles) ;

    }



    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->passwordHash;
    }

    public function setPassword(string $passwordHash): self
    {
        $this->passwordHash = $passwordHash;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }

    public function __construct()
    {
        $this->booksCollection = new ArrayCollection();
    }

  

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPasswordHash(): ?string
    {
        return $this->passwordHash;
    }
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
    
    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function setPasswordHash(string $passwordHash): self
    {
        $this->passwordHash = $passwordHash;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooksCollection(): Collection
    {
        return $this->booksCollection;
    }

    public function addBooksCollection(Book $booksCollection): self
    {
        if (!$this->booksCollection->contains($booksCollection)) {
            $this->booksCollection[] = $booksCollection;
        }

        return $this;
    }

    public function removeBooksCollection(Book $booksCollection): self
    {
        if ($this->booksCollection->contains($booksCollection)) {
            $this->booksCollection->removeElement($booksCollection);
        }

        return $this;
    }

    public function getFollowedBook(): Collection
    {
        return $this->followedBooks;
    }

    public function addFollowedBook(Book $followedBooks): self
    {
        if (!$this->followedBooks->contains($followedBooks)) {
            $this->followedBooks[] = $followedBooks;
        }

        return $this;
    }

    public function removeFollowedBook(Book $followedBooks): self
    {
        if ($this->followedBooks->contains($followedBooks)) {
            $this->followedBooks->removeElement($followedBooks);
        }

        return $this;
    }
    public function getRememberSession(): ?string
    {
        return $this->rememberSession;
    }
    
    public function setRememberSession(string $rememberSession): self
    {
        $this->rememberSession = $rememberSession;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }
    
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getHeadShot()
    {
            $path="user_photo/";
      return file_exists($path.$this->id)?$this->id:0;
      
    }

    public function getPhotoPath(): ?string
    {
        return $this->photoPath;
    }

    public function setPhotoPath(?string $photoPath): self
    {
        $this->photoPath = $photoPath;

        return $this;
    }
}

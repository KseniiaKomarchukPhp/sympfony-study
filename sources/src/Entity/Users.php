<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @author Kseniia Komarchuk <kseniia.komarchuk@gmail.com>
 */
class Users
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $user_name;

    /**
     * @var date
     * @ORM\Column(type="date")
     */
    private $date_of_birth;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $club;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $role;

    /**
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    /**
     * @param string $user_name
     * @return $this
     */
    public function setUserName($user_name): self
    {
        $this->user_name = $user_name;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->date_of_birth;
    }

    /**
     * @param \DateTimeInterface $date_of_birth
     * @return $this
     */
    public function setDateOfBirth(\DateTimeInterface $date_of_birth): self
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return $this
     */
    public function setCity($city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getClub(): ?string
    {
        return $this->club;
    }

    /**
     * @param string $club
     * @return $this
     */
    public function setClub($club): self
    {
        $this->club = $club;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string|null $role
     * @return $this
     */
    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }
}

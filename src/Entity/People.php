<?php

namespace App\Entity;

use App\Repository\PeopleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeopleRepository::class)]
class People
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column]
    private int $height;

    #[ORM\Column]
    private int $mass;

    #[ORM\Column(length: 255)]
    private string $hairColor;

    #[ORM\Column(length: 255)]
    private string $skinColor;

    #[ORM\Column(length: 255)]
    private string $eyeColor;

    #[ORM\Column(length: 255)]
    private string $birthYear;

    #[ORM\Column(length: 255)]
    private string $gender;

    #[ORM\Column(length: 255)]
    private string $homeWorld;

    #[ORM\Column]
    private array $films = [];

    #[ORM\Column]
    private array $vehicles = [];

    #[ORM\Column]
    private array $species = [];

    #[ORM\Column]
    private array $starships = [];

    #[ORM\Column]
    private \DateTimeImmutable $updatedAt;

    #[ORM\Column(length: 255)]
    private ?string $url = null;


    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function getMass(): int
    {
        return $this->mass;
    }

    public function setMass(int $mass): void
    {
        $this->mass = $mass;
    }

    public function getHairColor(): string
    {
        return $this->hairColor;
    }

    public function setHairColor(string $hairColor): void
    {
        $this->hairColor = $hairColor;
    }

    public function getSkinColor(): string
    {
        return $this->skinColor;
    }

    public function setSkinColor(string $skinColor): void
    {
        $this->skinColor = $skinColor;
    }

    public function getEyeColor(): string
    {
        return $this->eyeColor;
    }

    public function setEyeColor(string $eyeColor): void
    {
        $this->eyeColor = $eyeColor;
    }

    public function getBirthYear(): string
    {
        return $this->birthYear;
    }

    public function setBirthYear(string $birthYear): void
    {
        $this->birthYear = $birthYear;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    public function getHomeWorld(): string
    {
        return $this->homeWorld;
    }

    public function setHomeWorld(string $homeWorld): void
    {
        $this->homeWorld = $homeWorld;
    }

    public function getFilms(): array
    {
        return $this->films;
    }

    public function setFilms(array $films): void
    {
        $this->films = $films;
    }

    public function getSpecies(): array
    {
        return $this->species;
    }

    public function setSpecies(array $species): void
    {
        $this->species = $species;
    }

    public function getStarships(): array
    {
        return $this->starships;
    }

    public function setStarships(array $starships): void
    {
        $this->starships = $starships;
    }

    public function getVehicles(): array
    {
        return $this->vehicles;
    }

    public function setVehicles(array $vehicles): void
    {
        $this->vehicles = $vehicles;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}

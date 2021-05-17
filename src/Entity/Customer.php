<?php

namespace App\Entity;

use DateTimeInterface;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Customer
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;
    /**
     * @ORM\Column(type="string", length=5000)
     */
    private $faceData;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $CIN;

    /**
     * @ORM\Column(type="integer")
     */
    private $Wage;

    /**
     * @ORM\Column(type="text")
     */
    private $image;

        /**
     * @ORM\Column(type="string")
     */
    private $workLocation;
   


    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFaceData(): ?string
    {

        return $this->faceData;
    }

    function setFaceData(string $faceData): self
    {
        $this->faceData = $faceData;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'userName' => $this->getUserName(),
            'password' => $this->getPassword(),
            'cin' => $this->getCIN(),
            'faceData' => $this ->getFaceData(),
            'Wage' => $this ->getWage(),
            'image'=> $this ->getImage(),
        ];
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCIN(): ?int
    {
        return $this->CIN;
    }

    public function setCIN(int $CIN): self
    {
        $this->CIN = $CIN;

        return $this;
    }

    public function getWage(): ?int
    {
        return $this->Wage;
    }

    public function setWage(int $Wage): self
    {
        $this->Wage = $Wage;

        return $this;
    }



    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setWorkLocation(string $workLocation): self
    {
        $this->workLocation = $workLocation;

        return $this;
    }

    public function getWorkLocation(): ?string
    {
        return $this->workLocation;
    }
}

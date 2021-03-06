<?php

namespace App\Entity;

use App\Repository\PresenceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PresenceRepository::class)
 */
class Presence
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255)
     */
    private $CIN;

    /**
     * @ORM\Column(type="string", length=2000, nullable=true)
     */
    private $Dates;



    public function getCIN(): ?string
    {
        return $this->CIN;
    }

    public function setCIN(string $CIN): self
    {
        $this->CIN = $CIN;

        return $this;
    }

    public function getDates(): ?string
    {
        return $this->Dates;
    }

    public function setDates(?string $Dates): self
    {
        $this->Dates = $Dates;

        return $this;
    }
    public function toArray(): array
{
    return [
        'cin' => $this->getCIN(),
        'dates' => $this ->getDates()
    ];
}
}

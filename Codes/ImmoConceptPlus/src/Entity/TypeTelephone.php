<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeTelephoneRepository")
 */
class TypeTelephone
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=100)
     */
    private $id;

    public function getId(): ?string
    {
        return $this->id;
    }
}

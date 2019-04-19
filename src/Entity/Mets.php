<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Mets
 *
 * @ORM\Table(name="mets")
 * @ORM\Entity
 */
class Mets
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="text", length=0, nullable=true)
     */
    private $image;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Vin", inversedBy="mets", fetch="EAGER")
     * @ORM\JoinTable(name="mets_vin",
     *   joinColumns={
     *     @ORM\JoinColumn(name="mets_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="vin_id", referencedColumnName="id")
     *   }
     * )
     */
    private $vin;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vin = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Vin[]
     */
    public function getVin(): Collection
    {
        return $this->vin;
    }

    public function addVin(Vin $vin): self
    {
        if (!$this->vin->contains($vin)) {
            $this->vin[] = $vin;
        }

        return $this;
    }

    public function removeVin(Vin $vin): self
    {
        if ($this->vin->contains($vin)) {
            $this->vin->removeElement($vin);
        }

        return $this;
    }

}

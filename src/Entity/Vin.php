<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Vin
 *
 * @ORM\Table(name="vin", indexes={@ORM\Index(name="IDX_B108514129276EF3", columns={"met_id"})})
 * @ORM\Entity
 */
class Vin
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255, nullable=false)
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prix", type="text", length=255, nullable=true)
     */
    private $prix;

    /**
     * @var string|null
     *
     * @ORM\Column(name="appelation", type="string", length=255, nullable=true)
     */
    private $appelation;

    /**
     * @var \Mets
     *
     * @ORM\ManyToOne(targetEntity="Mets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="met_id", referencedColumnName="id")
     * })
     */
    private $met;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Mets", mappedBy="vin")
     * @ORM\JoinTable(name="mets_vin",
     *      joinColumns={
     *     @ORM\JoinColumn(name="vin_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="mets_id", referencedColumnName="id")
     *   }
     * )
     */
    private $mets;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

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

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(?string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getAppelation(): ?string
    {
        return $this->appelation;
    }

    public function setAppelation(?string $appelation): self
    {
        $this->appelation = $appelation;

        return $this;
    }

    public function getMet(): ?Mets
    {
        return $this->met;
    }

    public function setMet(?Mets $met): self
    {
        $this->met = $met;

        return $this;
    }

    /**
     * @return Collection|Mets[]
     */
    public function getMets(): Collection
    {
        return $this->mets;
    }

    public function addMet(Mets $met): self
    {
        if (!$this->mets->contains($met)) {
            $this->mets[] = $met;
            $met->addVin($this);
        }

        return $this;
    }

    /*
    public function addMets(Array $mets): self
    {
        foreach($mets as $met)
        {
            $this->addMet($met);
        }
        return $this;
    }*/

    public function removeMet(Mets $met): self
    {
        if ($this->mets->contains($met)) {
            $this->mets->removeElement($met);
            $met->removeVin($this);
        }

        return $this;
    }

    /*
    public function removeMets()
    {

        $mets = $this->getMets();
        $val = $mets->count();
        for($i=0; $i<$val; $i++) {
            $met = $mets->get($i);
            $this->mets->removeElement($met);
            $met->removeVin($this);
        }
       // $mets = $this->getMets();
       // $mets->clear();

        return $this;
    }
*/

}

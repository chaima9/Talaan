<?php

namespace App\Entity;

use App\Repository\EtapedetransactionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtapedetransactionRepository::class)
 */
class Etapedetransaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    public $num_etape;

    /**
     * @ORM\OneToMany(targetEntity=Opportunity::class, mappedBy="etapedetransaction")
     */
    private $opportunities;

    public function __construct()
    {
        $this->opportunities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumEtape(): ?int
    {
        return $this->num_etape;
    }

    public function setNumEtape(int $num_etape): self
    {
        $this->num_etape = $num_etape;

        return $this;
    }

    /**
     * @return Collection|Opportunity[]
     */
    public function getOpportunities(): Collection
    {
        return $this->opportunities;
    }

    public function addOpportunity(Opportunity $opportunity): self
    {
        if (!$this->opportunities->contains($opportunity)) {
            $this->opportunities[] = $opportunity;
            $opportunity->setEtapedetransaction($this);
        }

        return $this;
    }

    public function removeOpportunity(Opportunity $opportunity): self
    {
        if ($this->opportunities->removeElement($opportunity)) {
            // set the owning side to null (unless already changed)
            if ($opportunity->getEtapedetransaction() === $this) {
                $opportunity->setEtapedetransaction(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\OpportunityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=OpportunityRepository::class)
 */
class Opportunity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datedesoumission;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datedattribution;

    /**
     * @ORM\Column(type="float")
     *  @Assert\NotEqualTo(
     *      value = 0,
     *      message = "La valeur totale  ne doit pas être égal à 0 "
     * )
     */
    private $valeurtotale;

    /**
     * @ORM\Column(type="float")
     *  @Assert\NotEqualTo(
     *      value = 0,
     *      message = "La valeur nette  ne doit pas être égal à 0 "
     * )
     */
    private $valeurnette;

    /**
     * @ORM\ManyToOne(targetEntity=Departement::class, inversedBy="opportunities")
     */
    private $departement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Statut="Libre";

    /**
     * @ORM\Column(type="float")
     */
    private $confiance;

    /**
     * @ORM\Column(type="text")
     */
    private $accord;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="opportunities")
     */
    private $pays;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="opportunities")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Territoire::class, inversedBy="opportunities")
     */
    private $territoire;

    /**
     * @ORM\ManyToOne(targetEntity=Etapedetransaction::class, inversedBy="opportunities")
     */
    private $etapedetransaction;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $commercial;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomcommercial;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedesoumission(): ?\DateTimeInterface
    {
        return $this->datedesoumission;
    }

    public function setDatedesoumission(\DateTimeInterface $datedesoumission): self
    {
        $this->datedesoumission = $datedesoumission;

        return $this;
    }

    public function getDatedattribution(): ?\DateTimeInterface
    {
        return $this->datedattribution;
    }

    public function setDatedattribution(?\DateTimeInterface $datedattribution): self
    {
        $this->datedattribution = $datedattribution;

        return $this;
    }

    public function getValeurtotale(): ?float
    {
        return $this->valeurtotale;
    }

    public function setValeurtotale(float $valeurtotale): self
    {
        $this->valeurtotale = $valeurtotale;

        return $this;
    }

    public function getValeurnette(): ?float
    {
        return $this->valeurnette;
    }

    public function setValeurnette(float $valeurnette): self
    {
        $this->valeurnette = $valeurnette;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->Statut;
    }

    public function setStatut(string $Statut): self
    {
        $this->Statut = $Statut;

        return $this;
    }

    public function getConfiance(): ?float
    {
        return $this->confiance;
    }

    public function setConfiance(float $confiance): self
    {
        $this->confiance = $confiance;

        return $this;
    }

    public function getAccord(): ?string
    {
        return $this->accord;
    }

    public function setAccord(string $accord): self
    {
        $this->accord = $accord;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getTerritoire(): ?Territoire
    {
        return $this->territoire;
    }

    public function setTerritoire(?Territoire $territoire): self
    {
        $this->territoire = $territoire;

        return $this;
    }

    public function getEtapedetransaction(): ?Etapedetransaction
    {
        return $this->etapedetransaction;
    }

    public function setEtapedetransaction(?Etapedetransaction $etapedetransaction): self
    {
        $this->etapedetransaction = $etapedetransaction;

        return $this;
    }

    public function getCommercial(): ?int
    {
        return $this->commercial;
    }

    public function setCommercial(?int $commercial): self
    {
        $this->commercial = $commercial;

        return $this;
    }

    public function getNomcommercial(): ?string
    {
        return $this->nomcommercial;
    }

    public function setNomcommercial(?string $nomcommercial): self
    {
        $this->nomcommercial = $nomcommercial;

        return $this;
    }
}

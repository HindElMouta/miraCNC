<?php

namespace App\Entity;

use App\Repository\MachineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MachineRepository::class)]
class Machine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 4)]
    private ?string $annee = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $modele = null;

    #[ORM\Column(name: "course_x", length: 255, nullable: true)]
    private ?string $courseX = null;

    #[ORM\Column(name: "course_y", length: 255, nullable: true)]
    private ?string $courseY = null;

    #[ORM\Column(name: "course_z", length: 255, nullable: true)]
    private ?string $courseZ = null;

    #[ORM\Column(name: "vitesse_rotation", length: 255, nullable: true)]
    private ?string $vitesseRotation = null;

    #[ORM\Column(name: "type_attachement", length: 255, nullable: true)]
    private ?string $typeAttachement = null;

    #[ORM\Column(name: "img_filesname",length: 255, nullable: true)]
    private ?string $imgFilename = null;



    // Méthodes getter pour les propriétés

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }


    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function getCourseX(): ?string
    {
        return $this->courseX;
    }

    public function getCourseY(): ?string
    {
        return $this->courseY;
    }

    public function getCourseZ(): ?string
    {
        return $this->courseZ;
    }

    /**
     * @return string|null
     */
    public function getImgFilename(): ?string
    {
        return $this->imgFilename;
    }

    // Méthodes setter pour les propriétés

    /**
     * @param int|null $id
     * @return Machine
     */
    public function setId(?int $id): Machine
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string|null $reference
     * @return Machine
     */
    public function setReference(?string $reference): Machine
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @param string|null $annee
     * @return Machine
     */
    public function setAnnee(?string $annee): Machine
    {
        $this->annee = $annee;
        return $this;
    }

    /**
     * @param string|null $modele
     * @return Machine
     */
    public function setModele(?string $modele): Machine
    {
        $this->modele = $modele;
        return $this;
    }

    /**
     * @param string|null $courseX
     * @return Machine
     */
    public function setCourseX(?string $courseX): Machine
    {
        $this->courseX = $courseX;
        return $this;
    }

    /**
     * @param string|null $courseY
     * @return Machine
     */
    public function setCourseY(?string $courseY): Machine
    {
        $this->courseY = $courseY;
        return $this;
    }

    /**
     * @param string|null $courseZ
     * @return Machine
     */
    public function setCourseZ(?string $courseZ): Machine
    {
        $this->courseZ = $courseZ;
        return $this;
    }

    /**
     * @param string|null $imgFilename
     * @return Machine
     */
    public function setImgFilename(?string $imgFilename): Machine
    {
        $this->imgFilename = $imgFilename;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVitesseRotation(): ?string
    {
        return $this->vitesseRotation;
    }

    /**
     * @param string|null $vitesseRotation
     * @return Machine
     */
    public function setVitesseRotation(?string $vitesseRotation): Machine
    {
        $this->vitesseRotation = $vitesseRotation;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTypeAttachement(): ?string
    {
        return $this->typeAttachement;
    }

    /**
     * @param string|null $typeAttachement
     * @return Machine
     */
    public function setTypeAttachement(?string $typeAttachement): Machine
    {
        $this->typeAttachement = $typeAttachement;
        return $this;
    }


}

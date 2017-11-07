<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeVisite", type="datetime")
     */
    private $dateDeVisite;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="typeTicket", type="string", length=255)
     */
    private $typeTicket;

    /**
     * @var string
     *
     * @ORM\Column(name="prixCommande", type="string", length=255)
     */
    private $prixCommande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeCommande", type="datetime")
     */
    private $dateDeCommande;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ticket", mappedBy="commande", cascade={"PERSIST", "REMOVE"})
     */
    private $tickets;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Commande
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Commande
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateDeVisite
     *
     * @param \DateTime $dateDeVisite
     *
     * @return Commande
     */
    public function setDateDeVisite($dateDeVisite)
    {
        $this->dateDeVisite = $dateDeVisite;

        return $this;
    }

    /**
     * Get dateDeVisite
     *
     * @return \DateTime
     */
    public function getDateDeVisite()
    {
        return $this->dateDeVisite;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Commande
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set typeTicket
     *
     * @param string $typeTicket
     *
     * @return Commande
     */
    public function setTypeTicket($typeTicket)
    {
        $this->typeTicket = $typeTicket;

        return $this;
    }

    /**
     * Get typeTicket
     *
     * @return string
     */
    public function getTypeTicket()
    {
        return $this->typeTicket;
    }

    /**
     * Set prixCommande
     *
     * @param string $prixCommande
     *
     * @return Commande
     */
    public function setPrixCommande($prixCommande)
    {
        $this->prixCommande = $prixCommande;

        return $this;
    }

    /**
     * Get prixCommande
     *
     * @return string
     */
    public function getPrixCommande()
    {
        return $this->prixCommande;
    }

    /**
     * Set dateDeCommande
     *
     * @param \DateTime $dateDeCommande
     *
     * @return Commande
     */
    public function setDateDeCommande($dateDeCommande)
    {
        $this->dateDeCommande = $dateDeCommande;

        return $this;
    }

    /**
     * Get dateDeCommande
     *
     * @return \DateTime
     */
    public function getDateDeCommande()
    {
        return $this->dateDeCommande;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
            $this->tickets = new \Doctrine\Common\Collections\ArrayCollection();
            $this->dateDeCommande= new \DateTime();
    }

    /**
     * Add ticket
     *
     * @param \AppBundle\Entity\Ticket $ticket
     *
     * @return Commande
     */
    public function addTicket(\AppBundle\Entity\Ticket $ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param \AppBundle\Entity\Ticket $ticket
     */
    public function removeTicket(\AppBundle\Entity\Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTickets()
    {
        return $this->tickets;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TicketRepository")
 */
class Ticket
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
     * @ORM\Column(name="nomTicket", type="string", length=255)
     */
    private $nomTicket;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomTicket", type="string", length=255)
     */
    private $prenomTicket;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
    private $pays;

    /**
     * @var \datetime
     *
     * @ORM\Column(name="dateDeNaissance", type="datetime")
     */
    private $dateDeNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=255)
     */
    private $prix;

    /**
     * @var bool
     *
     * @ORM\Column(name="tarif", type="boolean")
     */
    private $tarif;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Commande", inversedBy="tickets")
     */
    private $commande;


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
     * Set nomTicket
     *
     * @param string $nomTicket
     *
     * @return Ticket
     */
    public function setNomTicket($nomTicket)
    {
        $this->nomTicket = $nomTicket;

        return $this;
    }

    /**
     * Get nomTicket
     *
     * @return string
     */
    public function getNomTicket()
    {
        return $this->nomTicket;
    }

    /**
     * Set prenomTicket
     *
     * @param string $prenomTicket
     *
     * @return Ticket
     */
    public function setPrenomTicket($prenomTicket)
    {
        $this->prenomTicket = $prenomTicket;

        return $this;
    }

    /**
     * Get prenomTicket
     *
     * @return string
     */
    public function getPrenomTicket()
    {
        return $this->prenomTicket;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Ticket
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set dateDeNaissance
     *
     * @param string $dateDeNaissance
     *
     * @return Ticket
     */
    public function setDateDeNaissance($dateDeNaissance)
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    /**
     * Get dateDeNaissance
     *
     * @return string
     */
    public function getDateDeNaissance()
    {
        return $this->dateDeNaissance;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return Ticket
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set tarif
     *
     * @param boolean $tarif
     *
     * @return Ticket
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarid
     *
     * @return bool
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set commande
     *
     * @param \AppBundle\Entity\Commande $commande
     *
     * @return Ticket
     */
    public function setCommande(\AppBundle\Entity\Commande $commande = null)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \AppBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }
}

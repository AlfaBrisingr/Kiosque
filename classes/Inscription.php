<?php namespace Kiosque\Classes;

/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 10/12/2015
 * Time: 19:12
 */
class Inscription
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var Enseignant
     */
    private $enseignant;
    /**
     * @var \DateTime
     */
    private $date;
    /**
     * @var String
     */
    private $divers;
    /**
     * @var String
     */
    private $impo;
    /**
     * @var int
     */
    private $nbEnfants;
    /**
     * @var int
     */
    private $nbAdultes;
    /**
     * @var bool
     */
    private $validated = false;

    /**
     * @var Collection
     */
    private $lesChoix;

    /**
     * @var String
     */
    private $classe;

    /**
     * @param int $id
     * @param Enseignant $enseignant
     * @param \DateTime $date
     * @param String $divers
     * @param String $impo
     * @param int $nbEnfants
     * @param int $nbAdultes
     * @param String $classe
     */
    public function __construct($id, Enseignant $enseignant, \DateTime $date, $divers, $impo, $nbEnfants, $nbAdultes, $classe)
    {
        $this->id = (int) $id;
        $this->enseignant = $enseignant;
        $this->date = $date;
        $this->divers = $divers;
        $this->impo = $impo;
        $this->nbEnfants = (int) $nbEnfants;
        $this->nbAdultes = (int) $nbAdultes;
        $this->lesChoix = new Collection();
        $this->classe = $classe;
    }

    /**
     * @return String
     */
    public function getClasse() {
        return $this->classe;
    }

    /**
     * @param String $classe
     * @return Inscription
     */
    public function setClasse($classe) {
        $this->classe = $classe;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Inscription
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Enseignant
     */
    public function getEnseignant()
    {
        return $this->enseignant;
    }

    /**
     * @param Enseignant $enseignant
     * @return Inscription
     */
    public function setEnseignant($enseignant)
    {
        $this->enseignant = $enseignant;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Inscription
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return String
     */
    public function getDivers()
    {
        return $this->divers;
    }

    /**
     * @param String $divers
     * @return Inscription
     */
    public function setDivers($divers)
    {
        $this->divers = $divers;
        return $this;
    }

    /**
     * @return String
     */
    public function getImpo()
    {
        return $this->impo;
    }

    /**
     * @param String $impo
     * @return Inscription
     */
    public function setImpo($impo)
    {
        $this->impo = $impo;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbEnfants()
    {
        return $this->nbEnfants;
    }

    /**
     * @param int $nbEnfants
     * @return Inscription
     */
    public function setNbEnfants($nbEnfants)
    {
        $this->nbEnfants = (int) $nbEnfants;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbAdultes()
    {
        return $this->nbAdultes;
    }

    /**
     * @param int $nbAdultes
     * @return Inscription
     */
    public function setNbAdultes($nbAdultes)
    {
        $this->nbAdultes = (int) $nbAdultes;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isValidated()
    {
        return $this->validated;
    }

    /**
     * @param boolean $validated
     * @return Inscription
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getLesChoix()
    {
        return $this->lesChoix;
    }

    /**
     * @param Collection $lesChoix
     * @return Inscription
     */
    public function setLesChoix(Collection $lesChoix)
    {
        $this->lesChoix = $lesChoix;
        return $this;
    }

}
<?php namespace Kiosque\Classes;

/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 11/12/2015
 * Time: 01:00
 */
class Jauge
{
    /**
     * @var int
     */
    private $utilise;
    /**
     * @var int
     */
    private $restante;
    /**
     * @var int
     */
    private $max;
    /*
     * @var int
     */
    private $nbEnfants;
    /*
     * @var int
     */
    private $nbAdultes;
    /**
     * @var Seance
     */
    private $seance;

    /**
     * Jauge constructor.
     * @param int $utilise
     * @param int $restante
     * @param int $max
     * @param Seance $seance
     */
    public function __construct($utilise, $restante, $enfants, $adultes, $max, Seance $seance)
    {
        $this->utilise = (int) $utilise;
        $this->restante = (int) $restante;
        $this->nbEnfants = $enfants;
        $this->nbAdultes = $adultes;
        $this->max = (int) $max;
        $this->seance = $seance;
    }

    /**
     * @return int
     */
    public function getUtilise()
    {
        return $this->utilise;
    }

    /**
     * @param int $utilise
     * @return Jauge
     */
    public function setUtilise($utilise)
    {
        $this->utilise = (int) $utilise;
        return $this;
    }

    /**
     * @return int
     */
    public function getRestante()
    {
        return $this->restante;
    }

    /**
     * @param int $restante
     * @return Jauge
     */
    public function setRestante($restante)
    {
        $this->restante = (int) $restante;
        return $this;
    }

    /**
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param int $max
     * @return Jauge
     */
    public function setMax($max)
    {
        $this->max = (int) $max;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNbEnfants()
    {
        return $this->nbEnfants;
    }

    /**
     * @param mixed $nbEnfants
     */
    public function setNbEnfants($nbEnfants)
    {
        $this->nbEnfants = $nbEnfants;
    }

    /**
     * @return mixed
     */
    public function getNbAdultes()
    {
        return $this->nbAdultes;
    }

    /**
     * @param mixed $nbAdultes
     */
    public function setNbAdultes($nbAdultes)
    {
        $this->nbAdultes = $nbAdultes;
    }


    /**
     * @return Seance
     */
    public function getSeance()
    {
        return $this->seance;
    }

    /**
     * @param Seance $seance
     * @return Jauge
     */
    public function setSeance($seance)
    {
        $this->seance = $seance;
        return $this;
    }
}
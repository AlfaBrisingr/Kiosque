<?php

/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 10/12/2015
 * Time: 20:35
 */
class Choix
{
    /**
     * @var Inscription
     */
    private $inscription;
    /**
     * @var Spectacle
     */
    private $spectacle;
    /**
     * @var int
     */
    private $priorite;

    /**
     * Choix constructor.
     * @param Inscription $inscription
     * @param Spectacle $spectacle
     * @param int $priorite
     */
    public function __construct(Inscription $inscription, Spectacle $spectacle, $priorite)
    {
        $this->inscription = $inscription;
        $this->spectacle = $spectacle;
        $this->priorite = (int) $priorite;
    }

    /**
     * @return Inscription
     */
    public function getInscription()
    {
        return $this->inscription;
    }

    /**
     * @param Inscription $inscription
     * @return Choix
     */
    public function setInscription($inscription)
    {
        $this->inscription = $inscription;
        return $this;
    }

    /**
     * @return Spectacle
     */
    public function getSpectacle()
    {
        return $this->spectacle;
    }

    /**
     * @param Spectacle $spectacle
     * @return Choix
     */
    public function setSpectacle($spectacle)
    {
        $this->spectacle = $spectacle;
        return $this;
    }

    /**
     * @return int
     */
    public function getPriorite()
    {
        return $this->priorite;
    }

    /**
     * @param int $priorite
     * @return Choix
     */
    public function setPriorite($priorite)
    {
        $this->priorite = (int) $priorite;
        return $this;
    }


}
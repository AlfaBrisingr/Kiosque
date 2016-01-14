<?php

/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 10/12/2015
 * Time: 20:30
 */
class Planning
{
    /**
     * @var Seance
     */
    private $seance;
    /**
     * @var Inscription
     */
    private $inscription;

    /**
     * Planning constructor.
     * @param Seance $seance
     * @param Inscription $inscription
     */
    public function __construct(Seance $seance, Inscription $inscription)
    {
        $this->seance = $seance;
        $this->inscription = $inscription;
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
     * @return Planning
     */
    public function setSeance($seance)
    {
        $this->seance = $seance;
        return $this;
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
     * @return Planning
     */
    public function setInscription($inscription)
    {
        $this->inscription = $inscription;
        return $this;
    }


}
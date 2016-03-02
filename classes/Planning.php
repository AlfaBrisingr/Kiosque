<?php namespace Kiosque\Classes;

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
     * @var int
     */
    private $jaugeUtilise;

    /**
     * @var int
     */
    private $jaugeMax;


    /**
     * Planning constructor.
     * @param Seance $seance
     * @param Inscription $inscription
     */
    public function __construct(Seance $seance, Inscription $inscription)
    {
        $this->seance = $seance;
        $this->inscription = $inscription;
        $this->jaugeMax = $this->seance->getSpectacle()->getNbPlace();
        $this->jaugeUtilise = $this->inscription->getNbAdultes()+$this->inscription->getNbEnfants();

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

    /**
     * @return int
     */
    public function getJaugeUtilise()
    {
        return $this->jaugeUtilise;
    }

    /**
     * @param int $jaugeUtilise
     */
    public function setJaugeUtilise($jaugeUtilise)
    {
        $this->jaugeUtilise = $jaugeUtilise;
    }

    /**
     * @return int
     */
    public function getJaugeMax()
    {
        return $this->jaugeMax;
    }

    /**
     * @param int $jaugeMax
     */
    public function setJaugeRestante($jaugeMax)
    {
        $this->jaugeMax = $jaugeMax;
    }

    /**
     * @return int
     */
    public function getJaugeRestante(){
        return $this->jaugeMax - $this->jaugeUtilise;
    }


}
<?php namespace Kiosque\Classes;

/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 10/12/2015
 * Time: 20:26
 */
class Seance
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var Spectacle
     */
    private $spectacle;
    /**
     * @var \DateTime
     */
    private $date;
    /**
     * @var Lieu
     */
    private $lieu;

    /**
     * Seance constructor.
     * @param int $id
     * @param Spectacle $spectacle
     * @param DateTime $date
     * @param Lieu $lieu
     */
    public function __construct($id, Spectacle $spectacle, DateTime $date, Lieu $lieu)
    {
        $this->id = (int) $id;
        $this->spectacle = $spectacle;
        $this->date = $date;
        $this->lieu = $lieu;
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
     * @return Seance
     */
    public function setId($id)
    {
        $this->id = (int) $id;
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
     * @return Seance
     */
    public function setSpectacle($spectacle)
    {
        $this->spectacle = $spectacle;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     * @return Seance
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return Lieu
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param Lieu $lieu
     * @return Seance
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
        return $this;
    }


}
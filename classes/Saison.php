<?php
namespace Kiosque\Classes;

/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 10/12/2015
 * Time: 20:29
 */
class Saison
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $nom;
    /**
     * @var bool
     */
    private $courante = false;
    /**
     * @var Collection
     */
    private $lesSpectacles;

    /**
     * Saison constructor.
     * @param int $id
     * @param string $nom
     * @param bool $courante
     */
    public function __construct($id = 0, $nom = '', $courante = 0)
    {
        $this->id = (int) $id;
        $this->nom = $nom;
        $this->courante = $courante;
        $this->lesSpectacles = new Collection();
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
     * @return Saison
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Saison
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isCourante()
    {
        return $this->courante;
    }

    /**
     * @param boolean $courante
     * @return Saison
     */
    public function setCourante($courante)
    {
        $this->courante = $courante;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getLesSpectacles()
    {
        return $this->lesSpectacles;
    }

    /**
     * @param Collection $lesSpectacles
     * @return Saison
     */
    public function setLesSpectacles($lesSpectacles)
    {
        $this->lesSpectacles = $lesSpectacles;
        return $this;
    }
}
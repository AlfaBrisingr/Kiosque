<?php

/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 10/12/2015
 * Time: 20:25
 */
class Lieu
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
     * @var string
     */
    private $adresse;
    /**
     * @var string
     */
    private $cp;
    /**
     * @var string
     */
    private $ville;
    /**
     * @var Collection
     */
    private $lesSeances;

    /**
     * Lieu constructor.
     * @param int $id
     * @param string $nom
     * @param string $adresse
     * @param string $cp
     * @param string $ville
     */
    public function __construct($id, $nom, $adresse, $cp, $ville)
    {
        $this->id = (int) $id;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->cp = $cp;
        $this->ville = $ville;
        $this->lesSeances = new Collection();
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
     * @return Lieu
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
     * @return Lieu
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     * @return Lieu
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param string $cp
     * @return Lieu
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
        return $this;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     * @return Lieu
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getLesSeances()
    {
        return $this->lesSeances;
    }

    /**
     * @param Collection $lesSeances
     * @return Lieu
     */
    public function setLesSeances(Collection $lesSeances)
    {
        $this->lesSeances = $lesSeances;
        return $this;
    }

}
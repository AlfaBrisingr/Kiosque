<?php namespace Kiosque\Classes;

/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 10/12/2015
 * Time: 20:19
 */
class Spectacle
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
     * @var int
     */
    private $nbPlace;
    /**
     * @var string
     */
    private $typeClasse;
    /**
     * @var Collection
     */
    private $lesSeances;
    /**
     * @var Saison
     */
    private $saison;
    /**
     * @var int
     */
    private $typeSpectacle;


    /**
     * Spectacle constructor.
     * @param int $id
     * @param string $nom
     * @param int $nbPlace
     * @param string $typeClasse
     * @param Saison $saison
     */
    public function __construct($id, $nom, $nbPlace, $typeClasse, Saison $saison, $type)
    {
        $this->id = (int) $id;
        $this->nom = $nom;
        $this->nbPlace = (int) $nbPlace;
        $this->typeClasse = $typeClasse;
        $this->lesSeances = new Collection();
        $this->saison = $saison;
        $this->typeSpectacle = $type;
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
     * @return Spectacle
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
     * @return Spectacle
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbPlace()
    {
        return $this->nbPlace;
    }

    /**
     * @param int $nbPlace
     * @return Spectacle
     */
    public function setNbPlace($nbPlace)
    {
        $this->nbPlace = (int) $nbPlace;
        return $this;
    }

    /**
     * @return string
     */
    public function getTypeClasse()
    {
        return $this->typeClasse;
    }

    /**
     * @param string $typeClasse
     * @return Spectacle
     */
    public function setTypeClasse($typeClasse)
    {
        $this->typeClasse = $typeClasse;
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
     * @return Spectacle
     */
    public function setLesSeances(Collection $lesSeances)
    {
        $this->lesSeances = $lesSeances;
        return $this;
    }
    /**
     * @return int
     */
    public function getTypeSpectacle()
    {
        return $this->typeSpectacle;
    }

    /**
     * @param int $typeSpectacle
     */
    public function setTypeSpectacle($typeSpectacle)
    {
        $this->typeSpectacle = $typeSpectacle;
    }


}
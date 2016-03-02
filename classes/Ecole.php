<?php

/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 10/12/2015
 * Time: 19:21
 */
class Ecole
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $type;
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
    private $adresse2;
    /**
     * @var int
     */
    private $cp;
    /**
     * @var string
     */
    private $ville;
    /**
     * @var string
     */
    private $mailDirecteur;
    /**
     * @var Enseignant
     */
    private $directeur;

    /**
     * @param int        $id
     * @param int        $type
     * @param string     $nom
     * @param string     $adresse
     * @param string     $adresse2
     * @param int        $cp
     * @param string     $ville
     * @param string     $mail
     * @param Enseignant $directeur
     */
    public function __construct($id, $type, $nom, $adresse, $adresse2, $cp, $ville, $mail, Enseignant $directeur)
    {
        $this->id =            (int) $id;
        $this->type =          $type;
        $this->nom =           $nom;
        $this->adresse =       $adresse;
        $this->adresse2 =      $adresse2;
        $this->cp =            (int) $cp;
        $this->ville =         strtoupper($ville);
        $this->mailDirecteur = strtolower($mail);
        $this->directeur =     $directeur;
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
     * @return Ecole
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return Ecole
     */
    public function setType($type)
    {
        $this->type = $type;
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
     * @return Ecole
     */
    public function setNom($nom)
    {
        $this->nom = ucfirst(strtolower($nom));
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
     * @return Ecole
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdresse2()
    {
        return $this->adresse2;
    }

    /**
     * @param string $adresse2
     * @return Ecole
     */
    public function setAdresse2($adresse2)
    {
        $this->adresse2 = $adresse2;
        return $this;
    }

    /**
     * @return int
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param int $cp
     * @return Ecole
     */
    public function setCp($cp)
    {
        $this->cp = (int) $cp;
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
     * @return Ecole
     */
    public function setVille($ville)
    {
        $this->ville = strtoupper($ville);
        return $this;
    }

    /**
     * @return string
     */
    public function getMailDirecteur()
    {
        return $this->mailDirecteur;
    }

    /**
     * @param string $mailDirecteur
     * @return Ecole
     */
    public function setMailDirecteur($mailDirecteur)
    {
        $this->mailDirecteur = strtolower($mailDirecteur);
        return $this;
    }

    /**
     * @return Enseignant
     */
    public function getDirecteur()
    {
        return $this->directeur;
    }

    /**
     * @param Enseignant $directeur
     * @return Ecole
     */
    public function setDirecteur($directeur)
    {
        $this->directeur = $directeur;
        return $this;
    }


}
<?php

/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 10/12/2015
 * Time: 19:19
 */
class Enseignant
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $civilite;
    /**
     * @var string
     */
    private $nom;
    /**
     * @var string
     */
    private $prenom;
    /**
     * @var string
     */
    private $mail;
    /**
     * @var string
     */
    private $tel;
    /**
     * @var Ecole
     */
    private $ecole;
    /**
     * @var Collection
     */
    private $lesInscriptions;
    /**
     * @var int
     */
    private $typeEnseignant;

    /**
     * Enseignant constructor.
     * @param int $id
     * @param string $civilite
     * @param string $nom
     * @param string $prenom
     * @param string $mail
     * @param string $tel
     * @param int $type
     */
    public function __construct($id, $civilite, $nom, $prenom, $mail, $tel, $type)
    {
        $this->id = (int) $id;
        $this->civilite = $civilite;
        $this->nom = strtoupper($nom);
        $this->prenom = ucfirst(strtolower($prenom));
        $this->mail = $mail;
        $this->tel = $tel;
        $this->typeEnseignant = $type;
        $this->lesInscriptions = new Collection();
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
     * @return Enseignant
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * @param string $civilite
     * @return Enseignant
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
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
     * @return Enseignant
     */
    public function setNom($nom)
    {
        $this->nom = strtoupper($nom);
        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return Enseignant
     */
    public function setPrenom($prenom)
    {
        $this->prenom = ucfirst(strtolower($prenom));
        return $this;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     * @return Enseignant
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param string $tel
     * @return Enseignant
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
        return $this;
    }

    /**
     * @return Ecole
     */
    public function getEcole()
    {
        return $this->ecole;
    }

    /**
     * @param Ecole $ecole
     * @return Enseignant
     */
    public function setEcole(Ecole $ecole)
    {
        $this->ecole = $ecole;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getLesInscriptions()
    {
        return $this->lesInscriptions;
    }

    /**
     * @param Collection $lesInscriptions
     * @return Enseignant
     */
    public function setLesInscriptions(Collection $lesInscriptions)
    {
        $this->lesInscriptions = $lesInscriptions;
        return $this;
    }

    /**
     * @return int
     */
    public function getTypeEnseignant()
    {
        return $this->typeEnseignant;
    }

    /**
     * @param int $typeEnseignant
     */
    public function setTypeEnseignant($typeEnseignant)
    {
        $this->typeEnseignant = $typeEnseignant;
    }

}
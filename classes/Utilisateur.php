<?php
namespace Kiosque\Classes;
/**
 * Created by PhpStorm.
 * User: Kiyoz
 * Date: 10/12/2015
 * Time: 18:57
 */

class Utilisateur
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;

    /**
     * @param int $id
     * @param string $username
     * @param string $password
     */
    public function __construct($id = 0, $username = '', $password = '')
    {
        $this->id = (int) $id;
        $this->username = $username;
        $this->password = $password;
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
     * @return Utilisateur
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Utilisateur
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Utilisateur
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }




}
<?php namespace Kiosque\Classes;

class Collection
{
    /**
     * @var array
     */
    private $tab = array();

    /**
     * Ajpouter un elément à la collection
     * @param object $obj
     * @param null $key
     * @throws KeyHasUseException
     */
    public function ajouter($obj, $key = null)
    {
        if ($key == null) {
            $this->tab[] = $obj;
        } else {
            if (isset($this->tab[$key])) {
                throw new KeyHasUseException("Key $key already in use.");
            } else {
                $this->tab[$key] = $obj;
            }
        }
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getElement($key)
    {
        if (isset($this->tab[$key])) {
            return $this->tab[$key];
        } else {
            return("Vide");
        }
    }


    public function supprimer($key)
    {
        if (isset($this->tab[$key])) {
            unset($this->tab[$key]);
        } else {
            throw new KeyInvalidException("Invalid key $key.");
        }
    }

    public function getCollection()
    {
        return $this->tab;
    }

    public function getCles()
    {
        return array_keys($this->tab);
    }

    public function taille()
    {
        return count($this->tab);
    }

    public function cleExiste($key)
    {
        return isset($this->tab[$key]);
    }

    public function vider()
    {
        $this->tab = array();
    }
}
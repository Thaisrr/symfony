<?php
/**
 * Created by PhpStorm.
 * User: dawan
 * Date: 05/02/2019
 * Time: 10:15
 */

namespace App\Utils;


class Person
{

        private $nom;
        private $prenom;
        private $active;

    /**
     * Person constructor.
     * @param $nom
     * @param $prenom
     * @param $active
     */
    public function __construct($nom = null, $prenom = null, $active = true)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
    }





    public function __toString()
    {
        return "Person : [Nom : ".$this->getNom()." , Prénom : ".$this->getPrenom()." ]";
    }


}
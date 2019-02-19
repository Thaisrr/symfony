<?php
/**
 * Created by PhpStorm.
 * User: dawan
 * Date: 08/02/2019
 * Time: 16:14
 */

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class UniqueField
{
    private $em;
    private $entity;
    private $key, $value;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function setEntity($entity): self
    {
        $this->entity = $entity;
        return $this;
    }

    public function setParameter($key, $value): self
    {
        $this->key = $key;
        $this->value = $value;

        return $this;
    }

    public function isExist() // si il existe déjà dans la base, alors on ne pourra pas rajouter la même valeur
    {
        //$result = instance d'une classe ( entity : Auteur, par exemple, clef -> valeur
        $result =$this->em->getRepository($this->entity)->findOneby([$this->key => $this->value]);

        if ($result instanceof $this->entity) {
            return true;
        }
        return false;
    }
}
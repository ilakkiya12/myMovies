<?php

namespace mymovies\Domain;

class Category
{
    /**
     * Identifiant.
     *
     * @var integer
     */
    private $id;

    /**
     * Nom.
     *
     * @var string
     */
    private $name;


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->Name;
    }

    public function setName($name) {
        $this->name = $name;
    }


    
}
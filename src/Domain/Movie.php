<?php

namespace mymovies\Domain;

class Movie
{
    /**
     * Identifiant.
     *
     * @var integer
     */
    private $id;

    /**
     * Titre.
     *
     * @var string
     */
    private $title;
    
    private $descritptionShort;
    
    private $descriptionLong;
    
    private $director ;
    
    private $year;
    
    private $image;
    
    private $category;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->Title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

     public function getDescriptionShort() {
        return $this->DescriptionShort;
    }
    
    public function setDescriptionShort($descriptionShort){
        $this->descriptionShort= $descriptionShort;
    }
    
     public function getDescriptionLong() {
        return $this->DescriptionLong;
    }
    
    public function setDescriptionLong($descriptionLong){
        $this->descriptionLong= $descriptionLong;
    }
    
     public function getDirector() {
        return $this->Director;
    }
    
    public function setDirector($director){
        $this->director= $director;
    }
    
     public function getYear() {
        return $this->Year;
    }
    
   
    public function setYear($year){
        $this->year= $year;
    }
    
    public function getCategorie() {
        return $this->Categorie;
    }
    
    
    public function setCategory(Category $category){
        $this->category= $category;
    }
    
    public function getImage() {
        return $this->Image;
    }
    
    public function setImage($image){
        $this->image= $image;
    }
    
}

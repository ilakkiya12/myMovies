<?php

namespace GSB\DAO;

use GSB\Domain\Medicament;

class MedicamentDAO extends DAO
{
    /**
     * @var \GSB\DAO\FamilleDAO
     */
    private $familleDAO;

    public function setFamilleDAO(CategoryDAO $categoryDAO) {
        $this->categoryDAO = $categoryDAO;
    }

 
    public function findAll() {
        $sql = "select * from movie order by mov_id";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $movies = array();
        foreach ($result as $row) {
            $movieId = $row['mov_id'];
            $movies[$movieId] = $this->buildDomainObject($row);
        }
        return $movies;
    }




    protected function buildDomainObject($row) {
        $movie = new Movie();
        $movie->setId($row['mov_id']);
        $movie->setTitle($row['mov_title']);
        $movie->setDecriptionShort($row['mov_description_short']);
        $movie->setDecriptionLong($row['mov_description_long']);
        $movie->setDirector($row['mov_director']);
        $movie->setYear($row['mov_year']);
        $movie->setImage($row['mov_image']);
        
        if (array_key_exists('id_categorie', $row)) {
            
            $categoryID = $row['cat_id'];
            $category = $this->categoryDAO->find($categoryId);
            $movie->setCategory($category);
        }



   
        return $movie;
    }
}
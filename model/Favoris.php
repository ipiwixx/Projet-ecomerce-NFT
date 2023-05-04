<?php 

class favoris {
    
    /*
     * Attributs
     */
    private int $idProduit;
    private int $idClient;

    /*
     * Constructeur
     */
    public function __construct(){
        if(!isset($_SESSION)) {
            session_start();
        }
        if(!isset($_SESSION['favoris'])){
            $_SESSION['favoris'] = array();
        }
        if(isset($_GET['delFavoris'])){
            $this->del($_GET['delFavoris']);
        }
    }

    /*
    * Accesseurs
    */
    public function getIdProduit(): int {
        return $this->idProduit;
    }
    public function setIdProduit(int $idProduit) {
        $this->idProduit = $idProduit;
    }
    public function getIdClient(): int{
        return $this->idClient;
    }
    public function setIdClient(int $idClient){
        $this->idClient = $idClient;
    }


    public function add($product_id){
        if(!isset($_SESSION['favoris'][$product_id])){
            $_SESSION['favoris'][$product_id] = 1;
        }
    }

    public function del($product_id){
        unset($_SESSION['favoris'][$product_id]);
        NftManager::removeNftFavoris($_GET['delFavoris'], $_SESSION['id']);
    }
    
}

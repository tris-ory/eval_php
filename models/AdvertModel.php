<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/Db.php';

class AdvertModel extends Db
{
    public $db;
    public $id;
    public $title;
    public $description;
    public $postal_code;
    public $city;
    public $type;
    public $price;
    public $reservation_message = '';

    public function __construct(){
        $db = Db::getInstance();
        $this->db = $db->getDb();
    }

    public function addAdvert(){
        $stmt = $this->db->prepare('INSERT INTO `advert` (`title`, `description`, `postal_code`, `city`, `type`, `price`, `reservation_message`)
VALUES(:title, :description, :postal_code, :city, :type, :price, :reservation_message)');
        // No typing for stmt->bindValue because default is string and no decimal/float filter provided
        $stmt->bindValue(':title', $this->title);
        $stmt->bindValue(':description', $this->description);
        $stmt->bindValue(':postal_code', $this->postal_code);
        $stmt->bindValue(':city', $this->city);
        $stmt->bindValue(':type', $this->type);
        $stmt->bindValue(':price', $this->price);
        $stmt->bindValue(':reservation_message', $this->reservation_message);
        return $stmt->execute();
    }

    public function getLastNMsg($n){
        $stmt = $this->db->prepare('SELECT `id`, `title`, `description`, `postal_code`, `city`, `type`, 
       `price`, `reservation_message` FROM `advert` ORDER BY `created_at` DESC LIMIT :n');
        $stmt->bindParam(':n', $n, PDO::PARAM_INT);
        if($stmt->execute()){
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = false;
        }
        return $result;
    }

    public function getAll(){
        $stmt = $this->db->query('SELECT `id`, `title`, `description`, `postal_code`, `city`, `type`, 
       `price`, `reservation_message` FROM `advert`');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id){
        $stmt = $this->db->prepare('SELECT `id`, `title`, `description`, `postal_code`, `city`, `type`, 
       `price`, `reservation_message` FROM `advert` WHERE `id` = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function reserveAdvert(){
        $stmt = $this->db->prepare('UPDATE `advert` SET `reservation_message` = :msg WHERE `id` = :id');
        $stmt->bindValue(':msg', $this->reservation_message);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
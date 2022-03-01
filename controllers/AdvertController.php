<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/../models/AdvertModel.php';

class AdvertController
{
    public $errors;
    private $advert;

    public function __construct(){
        $this->advert = new AdvertModel();
    }

    public function getNLastMessages($n){
        return $this->advert->getLastNMsg($n);
    }

    public function getAll(){
        return $this->advert->getAll();
    }

    public function getById($id){
        return $this->advert->getById($id);
    }

    public function addAdvert(){
        // init the errors msg
        $this->errors = [];
        if(empty($_POST['title'])){
            $this->errors['title'] = 'Veuillez entrer un titre';
        } else {
            $text = $this->isValidText($_POST['title'], 50);
            if($text){
                $this->advert->title = $text;
            } else {
                $this->errors['title'] = 'Veuillez entrer un titre valide';
            }
        }
        if(empty($_POST['description'])){
            $this->errors['description'] = 'Veuillez entrer une description';
        } else {
            $text = $this->isValidText($_POST['description'], 255);
            if($text){
                $this->advert->description = $text;
            } else {
                $this->errors['description'] = 'Veuillez entrer une description valide';
            }
        }
        if(empty($_POST['type'])){
            $this->errors['type'] = 'Veuillez entrer un type';
        } elseif (strtolower($_POST['type']) === 'l' || strtolower($_POST['type']) === 'v'){
                $this->advert->type = $_POST['type'];
        } else {
            $this->errors['type'] = 'Veuillez entrer un type valide';
        }


        if(empty($_POST['postal_code'])){
            $this->errors['postal_code'] = 'Veuillez entrer un code postal';
        } elseif(preg_match('/^\d{5}$/', $_POST['postal_code'])){
                $this->advert->postal_code = $_POST['postal_code'];
        } else {
            $this->errors['postal_code'] = 'Veuillez entrer un code postal valide';
        }
        if(empty($_POST['city'])){
            $this->errors['city'] = 'Veuillez entrer une ville';
        } else {
            $text = $this->isValidText($_POST['city'], 50);
            if($text){
                $this->advert->city = $text;
            } else {
                $this->errors['city'] = 'Veuillez entrer une ville valide';
            }
        }
        if(empty($_POST['price'])){
            $this->errors['price'] = 'Veuillez entrer un prix';
        } else {
            $price = str_replace(',', '.', $_POST['price']);
            if($price >0 && $price < 10^7){
                $this->advert->price = $price;
            } else {
                $this->errors['price'] = 'Veuillez entrer un prix valide';
            }
        }

        /*
         elseif (preg_match('/^\d{1,6}(?:[.,]\d{0,2})?$/', $_POST['price'])){
            $price = str_replace(',', '.',$_POST['price']);
            $this->advert->price = $price;
        } else {
            $this->errors['price'] = 'Veuillez entrer un prix valide';
        }
         */
        // If no error
        if(empty($this->errors)){
            // result is true if insert is ok, false else
            $result = $this->advert->addAdvert();
        } else {
            // If some error, no try to insert, but return false
            $result = false;
        }
        return $result;
    }

    public function getErrors(){
        return $this->errors;
    }

    public function reserveAdvert($id, $msg){
        $text = $this->isValidText($msg, 255);
        if($text){
            $this->advert->id = $id;
            $this->advert->reservation_message = $text;
            $result = $this->advert->reserveAdvert();
        } else {
            $result = false;
        }
        return $result;
    }

    private function isValidText($text, $length){
        $newText = filter_var($text, FILTER_SANITIZE_STRING);
        // If the cleaned string is smaller than $length, return the string, false else
        return strlen($newText) > $length?false:$newText;
    }
}
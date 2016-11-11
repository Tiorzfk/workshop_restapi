<?php

function login() {
    if(!isset($_POST['email']) OR !isset($_POST['password'])){
      return Flight::json(array(
          "status"=>400,
          "message"=>"data tidak lengkap",
          "result"=>[]
      ));
    }
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = Flight::db();
    $q = $db->prepare("select * from user where email=:email and password=:password");
    $q->bindParam(':email', $email);
    $q->bindParam(':password', $password);

    $q->execute();

    if(count($q->fetchAll()) == 0){
      return Flight::json(array(
          "status"=>400,
          "message"=>"Email atau password yang anda masukan salah",
          "result"=>[]
      ));
    };
    $q->execute();
    return Flight::json(array(
        "status"=>200,
        "message"=>"Succeed",
        "result"=>$q->fetchAll()
    ));
}

function register() {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $db = Flight::db();
  $q = $db->prepare("insert into user (nama,email,password) value (:nama,:email,:password)");
  $q->bindParam(':nama', $nama);
  $q->bindParam(':email', $email);
  $q->bindParam(':password', $password);
  $q->execute();
  return Flight::json(array(
      "status"=>200,
      "message"=>"User berhasil dibuat"
  ));
}

function user() {
  $db = Flight::db();
  $q = $db->prepare("select * from user");
  $q->execute();
  return Flight::json(array(
      "status"=>200,
      "message"=>"Succeed",
      "result"=>$q->fetchAll()
  ));
}

function editUser() {
  $id = $_GET['id'];
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $db = Flight::db();
  $q = $db->prepare("update user set nama=:nama,email=:email,password=:password where id_user=:id");
  $q->bindParam(':nama', $nama);
  $q->bindParam(':email', $email);
  $q->bindParam(':password', $password);
  $q->bindParam(':id', $id);
  $q->execute();
  if(!$q->rowCount()){
    return Flight::json(array(
        "status"=>400,
        "message"=>"data gagal diubah",
        "result"=>[]
    ));
  };
  return Flight::json(array(
      "status"=>200,
      "message"=>"Data Berhasil Diubah",
  ));

}

function deleteUser(){
  $id = $_GET['id'];
  $db = Flight::db();
  $q = $db->prepare("delete from user where id_user=:id");
  $q->bindParam(':id',$id);
  $q->execute();
  return Flight::json(array(
      "status"=>200,
      "message"=>"Data Berhasil Dihapus",
  ));
}

?>

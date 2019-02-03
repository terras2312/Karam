<?php
/**
 * Created by PhpStorm.
 * User: mater
 * Date: 24/01/2019
 * Time: 19:31
 */
//include page-contact.html;
$nom=$_POST['nomPrenon'];
$email=$_POST['email'];
$titre=$_POST['object'];
$description=$_POST['description'];

$imageFile=$_FILES['image'];
$image=$_FILES['image']['name'];echo $image;
$targetDir="upload/";
$TargetFile= $targetDir.$imageFile['name'];
move_uploaded_file($imageFile['tmp_name'],$TargetFile);
try{
$bdd= new PDO('mysql:host=127.0.0.1:3306;dbname=projetpersonnelletroc;charset=utf8',
    'root',
    '');}
catch(Exception $e){echo $e->getMessage();};
$sql='insert into annonce (nomPrenom,email,titre,image,description) values (:nom,:email,:titre,:image,:description)';
$res=$bdd->prepare($sql);
$res->execute(['nom'=>$nom,
    'email' =>$email,
        'titre' =>$titre,
        'image'=>$image,
        'description'=>$description
    ]
   );
include "page-contact.htm";
$sql2='select* from annonce';
$res=$bdd->prepare($sql);
//$res->execute()->fetchAll();
print_r($res);


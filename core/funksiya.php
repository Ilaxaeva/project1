<?php
include 'config.php';


if(isset($_POST['login_calc'])){
if(5==$_POST['login_calc']){
$pass_check=$db->prepare('SELECT * FROM book where code=:code');
$pass_check->execute(array("code"=>md5($_POST['login_code'])));
$pass_count=$pass_check->RowCount();

if($pass_count>0){


    header('location:../index.php?login='.md5($_POST['login_code']));  

}else {

    header('location:../index.php?login=no');  
}



}else {
    header('location:../index.php?code=no');
}
}

// QEYDİYYAT BOLMESİ +++++++++++++++

if (isset($_POST['name'])) {




    $add_book = $db->prepare('INSERT into book set
name=:name,
author=:author,
type=:type,
img=:img,
date=:date,
code=:code
');
    $add_book->execute(
        array(
            'name' => xss_clean($_POST['name']),
            'author' => xss_clean($_POST['author']),
            'type' =>xss_clean($_POST['type']),
            'img' =>xss_clean($_POST['img']),
            'date'=>xss_clean($_POST['date']),
            'code' => xss_clean(md5($_POST['code']))
        )
    );


    if ($add_book) {
        header('location:../index.php');
    } else {
        header('location:../index.php?add=no');
    }


}



?>
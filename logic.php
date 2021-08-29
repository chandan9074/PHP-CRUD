<?php

$id = 0;
$name = "";
$popularity = 0;
$ranking = 0;



$connection = mysqli_connect("localhost", "root", "");

if(!$connection ){
    echo 'Connection Error';
}else if(!mysqli_select_db($connection, "quiz-2")){
    echo 'Database connected';
}

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $popularity = $_POST['popularity'];
    $ranking = $_POST['ranking'];

    $sql = "INSERT INTO uni_info (uni_name,popularity,ranking) VALUES('$name','$popularity','$ranking')";

    if(!mysqli_query($connection,$sql)){
        echo "Error in insertion";
    }else{
        header("refresh:2, url=index.php");

    }
}

if(isset($_GET['edit'])){
    $itemeId = $_GET['edit'];
    
     $itemEdit = $connection->query("SELECT * FROM uni_info WHERE id=$itemeId") or die($connection->error());

        if(count($itemEdit)==1){
            $data=$itemEdit->fetch_array();
            $id=$data['id'];
            $ifupdate=true;
            $name=$data['uni_name'];
            $popularity=$data['popularity'];
            $ranking=$data['ranking'];
    }else{
        echo "Something went wrong";

    }
}

?>
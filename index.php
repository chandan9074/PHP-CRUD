<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
      body{
        text-align:center;
      }

      label {
        padding:10px;
      }

      input{
        margin-left:20px;
        padding:10px;
        background-color:white;
      }

      form{
        display:inline-block;
      }

      .submit{
        font-size:14px;
        width: 120px;
        height: 4 0px;
        margin: 0 20%;
        background-color:#79BAEC;
        outline: none;
        color: white;
        cursor:pointer;
      }

      form {
        text-align: left;
        margin-top: 7vh;
      }

      table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-bottom:100px;
      }

      td,
      th {
        border: 2px solid #dddddd;
        text-align: left;
        padding:16px;
      }

      a{
        text-decoration:none;
        color:black;
        cursor:pointer;
        padding: 5px 10px;
        border-radious:20px;
      }

      .delete{
        background:red;
        color:white;
      }

      .edit{
        background:#79BAEC;
        color:white;
      }
    </style>

    <title>Document</title>

  </head>
  <body>
      <?php 
        $conn = mysqli_connect('localhost', 'root', '', 'quiz-2') or die(mysqli_error($conn));
        if(isset($_POST['search'])){
            $name= $_POST['search'];
            $data = "SELECT * from uni_info WHERE uni_name LIKE '%$name%'";
        }else{
            $data= "SELECT * FROM uni_info ORDER BY popularity DESC";
            $name="";
        }
        $result = mysqli_query($conn,$data);
      ?>
    
    <form action="" method="POST">
         <input id="name" name="search" type="text" value="<?php echo $name;?>" placeholder="University name...">
         <input type="submit" value="Search">
    </form>
    <br>

    <form action="operation.php" method="POST">
      <h1>Add University</h1>
        <input type="hidden" value="<?php echo $id;?>"  name="id" />
        <label>University Name: <input type="text" value="<?php echo $name;?>" name="name" /></label>
        <label>University Popularity: <input type="number" value="<?php echo $popularity;?>" name="popularity" /></label>
        <label>Rankikg: <input type="number" value="<?php echo $ranking;?>" name="ranking" /></label>

        
        <br>
          <input type="submit" value="Save" name="save" class="submit" />

    </form>

    <br /><br /><br />

    <h1>University Ranking</h1>
    <table align="center" style="width: 60%">
      <tr>
        <th>Ranking</th>
        <th>University Name</th>
        <th>Popularity</th>
        <th>Action</th>
        <th>Action</th>
      </tr>

      <?php 
        while ($row = $result->fetch_assoc()):?>
        <tr>
            <td><?php echo $row['ranking'];?></td>
            <td><?php echo $row['uni_name'];?></td>
            <td><?php echo $row['popularity'];?></td>
            <td>
                <a class="edit" href="index.php?edit=<?php echo $row['id']?>">Edit</a>
            </td>
            <td>
                <a class="delete" href="index.php?delete=<?php echo $row['id']?>">Delete</a>
            </td>
        </tr>
      <?php endwhile; ?>

    </table>
  </body>
</html>
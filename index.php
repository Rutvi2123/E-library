<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Upload Image</title>
</head>
<body>

   


    <div class="alert alert-secondary" role="alert">
        <h4 class="text-center">Upload Image</h4>
    </div>
    <div class="container col-12 m-5">
       <div class="col-6 m-auto">

        <?php
      if(isset($_POST['btn_img']))
      {
        $con = mysqli_connect("localhost","root","","library");

        $filename = $_FILES["choosefile"]["name"];
        $tempfile = $_FILES["choosefile"]["tmp_name"];
        $folder = "image/".$filename;
        $sql = "INSERT INTO `images`(`image`)VALUES('$filename')";
        if($filename == "")
        {
            echo 
            "
            <div class='alert alert-danger' role='alert'>
                <h4 class='text-center'>Blank not Allowed</h4>
            </div>
            ";
        }else{
            $result = mysqli_query($con, $sql);
            move_uploaded_file($tempfile, $folder);
            echo 
            "
            <div class='alert alert-success' role='alert'>
                <h4 class='text-center'>Image uploaded</h4>
            </div>
            ";
        }
      }

        
        ?>
     

         <form action="index.php" method="post" class="form-control" enctype="multipart/form-data">
            <input type="file" class="form-control" name="choosefile"  id="">
            <div class="col-6 m-auto ">
                <button type="submit" name="btn_img" class="btn btn-outline-success m-4">
                Submit
            </button>
            </div>
        </form>

        <table class="table text-center">
            <tr>
                <th>id</th>
                <th>image</th>
                <th>button</th>

            </tr>

            <?php
            $conn = mysqli_connect("localhost","root","","library");
            $sql2 = "SELECT*FROM `images` WHERE 1";
            $result2 = mysqli_query($conn, $sql2);
            while($fetch = mysqli_fetch_assoc($result2))
            {
                echo "";

                ?>

                <tr>
                    <td><?php echo $fetch['id'] ?></td>
                    <td><img src="./image/<?php echo $fetch['image'] ?>" width=100px alt=""></td>
                    <td><a href="delete.php?id=<?php echo $fetch['id'] ?>" class="btn btn-outline-danger">Delete</a></td>
                </tr>



                <?php
                "";
            } 
            ?>
        </table>

      
       


       </div>
    </div>

</body>
</html>
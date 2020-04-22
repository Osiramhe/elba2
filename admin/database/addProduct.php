
<?php
$dbServerName = "localhost";
$dbUserName ="root";
$dbPassword = "";
$dbName = "elbamarket";

$connProduce = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);


// define variables and set to empty values
$p_imageErr = $p_nameErr = $p_priceErr = $p_ratingErr = $p_quantityErr = $p_locationErr = $p_categoryErr = $p_packagingErr = $p_descriptionErr = "";

if (isset($_POST['addProduct'])) {
    if (empty($_POST["p_name"])) {
        $p_nameErr = "Name is required";
    } else {
        $p_name1 = test_input($_POST["p_name"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$p_name1)) {
            $p_nameErr = "Only letters and white space allowed";
        }else{
            $p_name = test_input($_POST["p_name"]);
        }
        
    }
    if (empty($_POST["p_category"])) {
        $p_categoryErr = "Category is required";
    } else {
        $p_category1 = test_input($_POST["p_category"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$p_category1)) {
            $p_categoryErr = "Only letters and white space allowed";
        }else{
            $p_category = test_input($_POST["p_category"]);
        }
        
    }
    if (empty($_POST["p_price"])) {
        $p_priceErr = "Price is required";
    } else {
        $p_price = test_input($_POST["p_price"]);
        
    }
    if (empty($_POST["p_packaging"])) {
        $p_packagingErr = "Name is required";
    } else {
        $p_packaging = test_input($_POST["p_packaging"]);
        
    }
    if (empty($_POST["p_rating"])) {
        $p_ratingErr = "rating is required";
    } else {
        $p_rating = test_input($_POST["p_rating"]);
        
    }
    if (empty($_POST["p_description"])) {
        $p_descriptionErr = "description is required";
    } else {
        $p_description1 = test_input($_POST["p_description"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$p_description1)) {
            $p_descriptionErr = "Only letters and white space allowed";
        }else{
            $p_description = test_input($_POST["p_description"]);
        }
        
    }
    if (empty($_POST["p_location"])) {
        $p_locationErr = "location is required";
    } else {
        $p_location1 = test_input($_POST["p_location"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$p_location1)) {
            $p_locationErr = "Only letters and white space allowed";
        }else{
            $p_location = test_input($_POST["p_location"]);
        }
        
    }
    if (empty($_POST["p_quantity"])) {
        $p_quantityErr = "quantity is required";
    } else {
        $p_quantity = test_input($_POST["p_quantity"]);
        
    }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
    if (isset($_POST["addProduct"])){
        $file = $_FILES['p_image'];
        $fileName = $_FILES['p_image']['name'];
        $fileTmpName = $_FILES['p_image']['tmp_name'];
        $fileSize = $_FILES['p_image']['size'];
        $fileError = $_FILES['p_image']['error'];
        $fileType = $_FILES['p_image']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'jfif');

        if (in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if ($fileSize < 10000000000){
                    $p_image = uniqid('', true).".".$fileActualExt;
                    $fileDest = "../pages/uploads/".$p_image;
                    move_uploaded_file($fileTmpName, $fileDest);
                } else {
                    echo "File size is more than the required";
                }
            } else {
                echo "There was an error uploading your file";
            }
        } else{
            echo "You can not upload files of this type!";
        }
        
    }
                    
if ($p_nameErr != "" && $p_categoryErr != "" && $p_priceErr != "" && $p_packagingErr != "" && $p_ratingErr != "" && $p_descriptionErr != "" && $p_locationErr != "" && $p_quantityErr != "" && $p_imageErr != ""){
    $date = date("y/m/d");echo "Hello";
    $time = date("h:i:sa");
    $sql = "INSERT INTO farmproduce(name, category, price, packaging, image, location, rating, quantity, description, date, time) VALUES ('$p_name','$p_category','$p_price','$p_packaging','$p_image','$p_location','$p_rating','$p_quantity','$p_description','$date','$time')";
    if ($connProduce->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location:../pages/menu-details.php?uploadsuccess");
    } else {
        echo "Error: " . $sql . "<br>" . $connProduce->error;
    }
}else{
    echo "Unsuccessful";
}
?>
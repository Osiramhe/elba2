<?php
$conn = mysqli_connect("localhost","root","","elbamarket");
$output ='';
if (isset($_POST["cat_value"])){
    $category = $_POST["cat_value"];
    if($_POST["cat_value"] != ''){
        $sql = "SELECT * FROM farmproduce WHERE category = '$category'";
    }else{
        $sql = "SELECT * FROM farmproduce";
    }
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result)){
        if ($row["ID"] === 0){
            $output .= '
                <h2 class="bradcaump-title" style="color:black;">There is currently no produce for sale.</h2>
            ';
        }elseif($row["ID"] >= 0){

        $output .= '
        <!-- Start Single Popular Food -->
          <div class="col-lg-4 col-md-6 col-sm-12 foo">
             <div class="popular__food">
                <div class="pp_food__thumb">
                   <a href="menu-details.html">
                   <img src="uploads/'.$row["image"].'" alt="popular food" height="211px">
                   </a>
                   <div class="pp__food__prize" title="Available Quantity">
                      <span>'.$row["quantity"].'</span>
                   </div>
                </div>
                <div class="pp__food__inner">
                   <div class="pp__food__details">
                      <h4><a href="menu-details.html">'.$row["name"].'</a></h4>
                       <p>&#8358 '.$row["price"].' <i>per</i> '.$row["packaging"].' kg</p>
                      <div class="pp__food__bottom d-flex justify-content-between align-items-center">
                         <div class="pp__btn">
                            <a class="food__btn btn--transparent btn__hover--theme btn__hover--theme" href="#">More</a>
                         </div>
                         <ul class="pp__meta d-flex">
                            <li><a href="editProduct.php?id='.$row["product_id"].'"><i class="fa  fa-file-text-o"></i>Edit</a></li>
                            <li><a href="deleteProduce.php?id='.$row["ID"].'"><i class="fa fa-trash-o"></i>Delete</a></li>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
          </div>
        <!-- End Single Popular Food -->
        ';
        }
    }
    echo $output;
}
?>
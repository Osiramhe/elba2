<?php
    include "db-conn.php";

    $sqlProduce = "SELECT * FROM farmproduce";
    $result = $conn->query($sqlProduce);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if ($row["ID"] === 0){
                echo '
                    <h2 class="bradcaump-title" style="color:black;">There is currently no produce for sale.</h2>
                ';
            }elseif($row["ID"] >= 0){

                echo '

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
                                  <ul class="rating">';
                                    $ratingNum = $row["rating"];
                                    $chgnum = 0;
                                    while ($chgnum < $ratingNum){
                                        echo'
                                            <li><i class="fa fa-star"></i></li>
                                        ';
                                        $chgnum = $chgnum + 1;
                                    }
                                  echo '</ul>
                                   <p>'.$row["price"].' <i>per</i> '.$row["packaging"].'</p>
                                  <div class="pp__food__bottom d-flex justify-content-between align-items-center">
                                     <div class="pp__btn">
                                        <a class="food__btn btn--transparent btn__hover--theme btn__hover--theme" href="#">More</a>
                                     </div>
                                     <ul class="pp__meta d-flex">
                                        <li><a href="#"><i class="fa  fa-file-text-o"></i>Edit</a></li>
                                        <li><a href="#"><i class="fa fa-trash-o"></i>Delete</a></li>
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
    }
?>
<!-- Start Single Popular Food -->
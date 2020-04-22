<?php
if(empty($_SESSION)){ // if the session not yet started
   session_start();
}
if(!isset($_SESSION['AdminId'])) { //if not yet logged in
   header("Location:login.php?Not logged in");// send to login page
   exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

        <title>Orders || ElbaMarket</title>
    <link rel="shortcut icon" href="../../images/logo/elba.png">

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../css/plugins.css">
    <link rel="stylesheet" href="../../style.css">
    <!-- Cusom css -->
    <link rel="stylesheet" href="../../css/custom.css">
    <!-- Modernizer js -->
    <script src="../../js/vendor/modernizr-3.5.0.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
            include "header.php";
        ?>
        <div id="page-wrapper">
            <div class="tab-content">
                <div class="tab-pane active" id="pills-pending" role="tabpanel" aria-labelledby="pills-pending-tab">
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Latest Orders
                                </div>
                                <h6 class="pl-4"></h6>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Customer name</th>
                                                <th>Customer email</th>
                                                <th>Home address</th>
                                                <th>town</th>
                                                <th>state</th>
                                                <th>Payment method</th>
                                                <th>product name</th>
                                                <th>product id</th>
                                                <th>product quantity</th>
                                                <th>Total price</th>
                                                <th>date</th>
                                                <th>time</th>
                                                <th>delivered</th>
                                                <th>DELETE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                
                                                <?php
                                                
                                                include "db-conn.php";
                                                $sql= "SELECT * FROM delivery ORDER BY date DESC, time DESC";
                                                $result = $conn->query($sql);
                                                $resultCheckSelect = mysqli_num_rows($result);

                                                if ($resultCheckSelect > 0) {
                                                    // output data of each row
                                                    while($row = $result->fetch_assoc()) {
                                                        $prId = $row["product_id"];
                                                        $sqlProduce= "SELECT * FROM farmproduce WHERE product_id ='$prId'";
                                                        $resultProduce = $conn->query($sqlProduce);
                                                        $resultCheckProduce = mysqli_num_rows($resultProduce);
                                                        if ($resultCheckProduce >0){
                                                            while($rowProduce = $resultProduce->fetch_assoc()){
                                                                $_SESSION["P_name"] = $rowProduce["name"];
                                                            }
                                                        }
                                                        if ($row["delivered"] == ""){
                                                            echo '
                                                            <tr class="odd gradeX">
                                                            <td>'.$row["username"].'</td>
                                                            <td>'.$row["email"].'</td>
                                                            <td>'.$row["home"].'</td>
                                                            <td>'.$row["town"].'</td>
                                                            <td>'.$row["state"].'</td>
                                                            <td>'.$row["method"].'</td>
                                                            <td>'.$_SESSION["P_name"].'</td>
                                                            <td>'.$row["product_id"].'</td>
                                                            <td>'.$row["quantity"].'</td>
                                                            <td class="center">#'.$row["total"].'</td>
                                                            <td class="center">'.$row["date"].'</td>

                                                            <td class="center">'.$row["time"].'</td>
                                                            <td class="row">
                                                            <div class="pp__btn col-xs-6">
                                                            <a class="btn btn-primary" href="delivered.php?id='.$row["delivery_id"].'">Delivered</a>
                                                            </div>
                                                            </td>
                                                            <td class="row">
                                                            <div class="pp__btn col-xs-6">
                                                            <a class="btn btn-danger" href="#">Delete</a>
                                                            </div>
                                                            </td>
                                                            </tr>

                                                            ';
                                                        }
                                                        
                                                        
                                                        
                                                        

                                                    }
                                                } else {
                                                    echo "0 results";
                                                }
                                                $conn->close();
                                                
                                                ?>
                                            
                                        </tbody>
                                    </table>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/plugins.js"></script>
    <script src="../../js/jquery.yu2fvl.js"></script>
    <script src="../../js/active.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>

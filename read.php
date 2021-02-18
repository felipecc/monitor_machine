<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>View Logs</title>
</head>

<body>
<div class="container">
        <div class="jumbotron">
            <div class="row">
            <?php
                $machineName = null;
                if(!empty($_GET['machine'])){
                    $machineName = $_REQUEST['machine'];
                }
                echo '<h2> Logs - '.$machineName.'</h2>';
            ?>
            </div>
          </div>
           <div class="row">
                <p>
                    <a href="index.php" type="btn" class="btn btn-default btn-success">Back</a>
                </p>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Date Time Log</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require 'database.php';
                            $id = null;
                            if (!empty($_GET['id'])) {
                                $id = $_REQUEST['id'];
                            }

                            if (null == $id) {
                                header("Location: index.php");
                            } else {
                                $pdo = Database::conectar();
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql = 'select * from ref_time where machine_id = :machine_id';                                
                               

                                $q = $pdo->prepare($sql);
                                $q->execute(array(':machine_id' => $id));

                                $all_records = $q->fetchAll();

                                foreach($all_records as $row)
                                {
                                    echo '<tr>';
                                    echo '<th scope="row">'. $row['id'] . '</th>';
                                    echo '<td>'. $row['time_ref'] . '</td>';
                                    echo '<td width=500>';
                                    echo '<a class="btn btn-primary" href="connection.php?id='.$row['id'].'&&machine='.$machineName.'&&datetimelog='.$row['time_ref'].'">Connection</a>';
                                    echo ' ';                                    
                                    echo '<a class="btn btn-primary" href="cpu.php?id='.$row['id'].'&&machine='.$machineName.'&&datetimelog='.$row['time_ref'].'">CPU</a>';
                                    echo ' ';
                                    echo '<a class="btn btn-primary" href="read.php?id='.$row['id'].'&&machine='.$machineName.'&&datetimelog='.$row['time_ref'].'">Men</a>';
                                    echo ' ';                                    
                                    echo '<a class="btn btn-primary" href="disk.php?id='.$row['id'].'&&machine='.$machineName.'&&datetimelog='.$row['time_ref'].'">Disk</a>';
                                    echo ' ';
                                    echo '<a class="btn btn-primary" href="users.php?id='.$row['id'].'&&machine='.$machineName.'&&datetimelog='.$row['time_ref'].'">Users</a>';
                                    echo ' ';
                                    echo '<a class="btn btn-primary" href="proccess.php?id='.$row['id'].'&&machine='.$machineName.'&&datetimelog='.$row['time_ref'].'">Process</a>';
                                    echo ' ';
                                    echo '</td>';
                                    echo '</tr>';
                                }

                                //echo '<a class="btn btn-primary" href="read.php?id='.$row['id'].'&&machine='.$row['name'].'">View Logs</a>';
                                Database::desconectar();
                            }                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>

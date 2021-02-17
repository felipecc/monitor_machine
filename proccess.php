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

                    $datetimeLog = null;
                    if(!empty($_GET['datetimelog'])){
                        $datetimeLog = $_REQUEST['datetimelog'];
                    }
                    echo '<h2> Logs >'.$machineName.'>'.$datetimeLog.'> Proccess </h2>';
                
                ?>
            </div>
          </div>
            </br>
            <div class="row">
                <p>
                    <button onclick="history.go(-1);" type="btn" class="btn btn-default btn-success">Back</button>
                </p>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">User</th>
                            <th scope="col">PID</th>
                            <th scope="col">VSZ</th>
                            <th scope="col">RSS</th>                            
                            <th scope="col">TTY</th>
                            <th scope="col">Stat</th>
                            <th scope="col">Start</th>
                            <th scope="col">Time</th>
                            <th scope="col">Command</th>
                            <th scope="col">CPU Percent</th>
                            <th scope="col">Men Percent</th>
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
                                $sql = 'select * from proccess_running where ref_time_id = :ref_time_id';                                
                               

                                $q = $pdo->prepare($sql);
                                $q->execute(array(':ref_time_id' => $id));

                                $all_records = $q->fetchAll();

                                foreach($all_records as $row)
                                {
                                    echo '<tr>';
                                    echo '<th scope="row">'. $row['id'] . '</th>';
                                    echo '<td>'. $row['user'] . '</td>';
                                    echo '<td>'. $row['pid'] . '</td>';
                                    echo '<td>'. $row['vsz'] . '</td>';
                                    echo '<td>'. $row['rss'] . '</td>';
                                    echo '<td>'. $row['tty'] . '</td>';
                                    echo '<td>'. $row['stat'] . '</td>';
                                    echo '<td>'. $row['start'] . '</td>';
                                    echo '<td>'. $row['time'] . '</td>';
                                    echo '<td>'. $row['command'] . '</td>';
                                    echo '<td>'. $row['cpu_percent'] . '</td>';
                                    echo '<td>'. $row['men_percent'] . '</td>';
                                }

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

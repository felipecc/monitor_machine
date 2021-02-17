

<?php
require 'database.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nameErro = null;
    $ipErro = null;
    $hostnameErro = null;
    $usernameErro = null;

    if (!empty($_POST)) {

        $validacao = True;
        $nameErro = False;
        if (!empty($_POST['name'])) {
            $name = $_POST['name'];
        } else {
            $nameErro = 'Please digit name for machine';
            $validacao = False;
        }


        if (!empty($_POST['ip'])) {
            $ip = $_POST['ip'];
        } else {
            $ipErro = 'Please digit IP Address';
            $validacao = False;
        }


        if (filter_var($_POST['ip'], FILTER_VALIDATE_IP)){
            $ip = $_POST['ip'];
        }else{
            $ipErro = 'Please digit valid IP Address';
            $validacao = False;
        }
        

        if (!empty($_POST['hostname'])) {
            $hostname = $_POST['hostname'];
        } else {
            $hostnameErro = 'Please digit hostname';
            $validacao = False;
        }


        if (!empty($_POST['username'])) {
            $username = $_POST['username'];
        } else {
            $usernameErro = 'Please digit username';
            $validacao = False;
        }
       

    }

//Inserindo no Database:
    if ($validacao) {
        $pdo = Database::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO machine (name, ip, hostname, username,active) VALUES(?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $ip, $hostname, $username, $active));
        Database::desconectar();
        header("Location: index.php");
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="assets/js/mask.ip-input.js"></script>    
    <title>Add Machine</title>
</head>

<body>
<div class="container">
    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Add Machine </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="create.php" method="post">

                    <div class="control-group  <?php echo !empty($nameErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="name" type="text" placeholder="Name"
                                   value="<?php echo !empty($name) ? $name : ''; ?>">
                            <?php if (!empty($nameErro)): ?>
                                <span class="text-danger"><?php echo $nameErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($ip) ? 'error ' : ''; ?>">
                        <label class="control-label">IP</label>
                        <div class="controls">
                            <input size="80" class="form-control" name="ip" placeholder="000.000.000.000" 
                                   value="<?php echo !empty($ip) ? $ip : ''; ?>">
                            <?php if (!empty($ipErro)): ?>
                                <span class="text-danger"><?php echo $ipErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($hostname) ? 'error ' : ''; ?>">
                        <label class="control-label">Hostname</label>
                        <div class="controls">
                            <input size="35" class="form-control" name="hostname" type="text" placeholder="Hostname"
                                   value="<?php echo !empty($hostname) ? $hostname : ''; ?>">
                            <?php if (!empty($hostnameErro)): ?>
                                <span class="text-danger"><?php echo $hostnameErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group <?php echo !empty($username) ? 'error ' : ''; ?>">
                        <label class="control-label">UserName</label>
                        <div class="controls">
                            <input size="35" class="form-control" name="username" type="text" placeholder="Username"
                                   value="<?php echo !empty($username) ? $username : ''; ?>">
                            <?php if (!empty($usernameErro)): ?>
                                <span class="text-danger"><?php echo $usernameErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-actions" >
                        <br/>
                        <button type="submit" class="btn btn-success">Add</button>
                        <a href="index.php" type="btn" class="btn btn-default">Back</a>
                    </div>
                </form>
            </div>
        </div>
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


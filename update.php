<?php

require 'database.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {

    $nameErro = null;
    $ipErro = null;
    $hostnameErro = null;
    $usernameErro = null;

    $name = $_POST['name'];
    $ip = $_POST['ip'];
    $hostname = $_POST['hostname'];
    $username = $_POST['username'];

    //Validação
    $validacao = true;
    if (empty($name)) {
        $nameErro = 'Please digit name for machine';
        $validacao = false;
    }

    if (empty($ip)) {
        $ipErro = 'Please digit IP Address';
        $validacao = false;
    } 

    if (!filter_var($ip, FILTER_VALIDATE_IP)){
        $ipErro = 'Please digit valid IP Address';
        $validacao = False;
    } 
    
    if (empty($_POST['hostname'])) {
        $hostnameErro = 'Please digit hostname';
        $validacao = False;
    }


    if (empty($_POST['username'])) {
        $usernameErro = 'Please digit username';
        $validacao = False;
    }

    // update data
    if ($validacao) {
        $pdo = Database::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE machine  set name = ?, ip = ?, hostname = ?, username = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $ip, $hostname, $username, $id));
        Database::desconectar();
        header("Location: index.php");
    }
    } else {
        $pdo = Database::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM machine where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['name'];
        $ip = $data['ip'];
        $hostname = $data['hostname'];
        $username = $data['username'];
        $active =  $data['active'];       
        Database::desconectar();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- using new bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Atualizar Contato</title>
</head>

<body>
<div class="container">
    <div clas="span10 offset1">
            <div class="card">
                <div class="card-header">
                    <h3 class="well"> Update Machine </h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="update.php?id=<?php echo $id ?>" method="post">
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
                        <div class="form-actions">
                            <br/>
                            <button type="submit" class="btn btn-success">Update</button>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD com PHP</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h2>Testando</h2>
    

    <form method="post" action="index.php">
    <div class="img-overlay"></div>
    <?php
        $pdo = new PDO('mysql:host=localhost;dbname=crud', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Inserindo no banco de dados

        if(isset($_GET['delete'])){
            $id = (int)$_GET['delete'];
            $pdo->exec("DELETE FROM tarefas WHERE id = $id");
            echo '<h2>deletado com sucesso</h2>';
        }

        if(isset($_POST['acao'])){
            $sql = $pdo->prepare("INSERT INTO tarefas values (null, ?)");
            $sql->execute(array($_POST['tarefa']));
            echo '<h2>inserido com sucesso';
        }

    ?>
        <h1>Lista de Tarefas</h1>
        <div class="list">
            <?php 
                $sql = $pdo->prepare("SELECT * FROM tarefas");
                $sql->execute();

                $clientes = $sql->fetchAll();
                foreach($clientes as $key => $value){
            ?>
            <div class="list-group">
                <h3><a href=""><?php echo $value['nome']; ?></a></h3><a href="?delete=<?php echo $value['id']; ?>"><i class="fa fa-times"></i></a>
            </div>

            <?php } ?>
        </div>
        <div class="inputs">
           <label for="text">Tarefa</label>
           <input name="tarefa" id="text" type="text" placeholder="Nome da tarefa" />
       </div>
        <input type="submit" name="acao" class="button" value="Adicionar Tarefa">
    </form>
    <script src="https://use.fontawesome.com/cb22164701.js"></script>
</body>
</html>
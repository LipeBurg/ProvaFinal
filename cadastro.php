<?php
$nome = $_POST['nome'];
$email = $_POST['email'];
$assunto = $_POST['assunto'];
$mensagem = $_POST['mensagem'];

$host = "localhost";
$database = "questoes";
$username = "root1";
$password = "projeto";

?>

<!DOCTYPE HTML>

<html>
    <head>
        <title>Cadastro</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
        try {
        $conexao = new PDO("mysql:host=$host;dbname=$database",$username,$password);

        $stmt = $conexao->prepare("INSERT INTO cadastro (nome,email,assunto,mensagem) 
        VALUES (:nome, :email, :assunto, :mensagem)");

        $ret = $stmt->execute(array("nome" =>$nome, "email" =>$email, "assunto" =>$assunto, "mensagem" =>$mensagem));

        if($ret){
            echo "Cadastrado com sucesso!";
        }else{
            echo "Erro ao cadastrar.";
        }

        }catch(PDOException $e){

            die($e-> getMessage());
        }
        ?>

        <table border="1">
            <thead>
                <tr><th>Nome</th><th>E-mail</th><th>Assunto</th><th>Mensagem</th></tr>
            </thead>
                <?php
                try{
                    $conexao = new PDO("mysql:host=$host;dbname=$database",$username,$password);
                    $conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $stmt = $conexao->prepare("SELECT * FROM cadastro");
                    $stmt->execute();
                    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }catch(PDO_Exception $e) {
                    die($e->getMessage());
                }

                ?>
                <tbody>
                <?php
                foreach ($resultado as $item) {
                    echo "<tr><td>".$item["nome"]."</td>";
                    echo "<td>".$item["email"]."</td>";
                    echo "<td>".$item["assunto"]."</td>";
                    echo "<td>".$item["mensagem"]."</td></tr>";
                }
                ?>
                </tbody>

        </table>
        
    </body>
</html> 
<!DOCTYPE html>
<?php
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
$title = "Atividade CRUD";
$procurar = isset($_POST['procurar']) ? $_POST['procurar'] : "";
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirma Exclusão?"))
                location.href = url;
        }
    </script>
</head>

<body>
    </br></br>
    <a href="info.php">Novo</a>
    </br></br>
    <form method="post">
        <input type="text" name="procurar" id="procurar" value="<?php echo $procurar; ?>">
        <input type="submit" value="Consultar">
    </form>
    <br>
    <?php

    $sql = "SELECT * FROM info WHERE descricao LIKE '$procurar%' ORDER BY descricao";

    $pdo = Conexao::getInstance();
    $consulta = $pdo->query($sql);
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        echo "Código: {$linha['ID']} - Descrição: {$linha['DESCRICAO']}";
        echo " - <a href=javascript:excluirRegistro('acao.php?acao=excluir&id={$linha['ID']}')>Excluir</a><br>";
    }
    ?>
</body>

</html>
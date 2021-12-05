<!DOCTYPE html>
<?php
include_once "../conf/default.inc.php";
require_once "../conf/Conexao.php";
$title = "AtivIDade CRUD";
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
        <input type="text" name="procurar" ID="procurar" value="<?php echo $procurar; ?>">
        <input type="submit" value="Consultar">
    </form>
    <br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Detalhes</th>
            <th>Alterar</th>
            <th>Excluir</th>
        </tr>
        <?php
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM info 
                             WHERE DESCRICAO 
                             LIKE '$procurar%'");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <tr>
                <td><?php echo $linha['ID']; ?></td>
                <td><?php echo $linha['DESCRICAO']; ?></td>
                <td><a href='show.php?ID=<?php echo $linha['ID']; ?>'><img class="icon" src="../img/show.png" alt=""> </a></td>
                <td><a href='cad.php?acao=editar&ID=<?php echo $linha['ID']; ?>'><img class="icon" src="../img/edit.png" alt=""></a></td>
                <td><a href="javascript:excluirRegistro('acao.php?acao=excluir&ID=<?php echo $linha['ID']; ?>')"><img class="icon" src="../img/delete.png" alt=""></a></td>
            </tr>
        <?php } ?>


</body>

</html>
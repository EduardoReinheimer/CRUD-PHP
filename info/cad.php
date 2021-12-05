<!DOCTYPE html>
<?php
include_once "acao.php";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar'){
    $ID = isset($_GET['ID']) ? $_GET['ID'] : "";
    if ($ID > 0)
        $dados = buscarDados($ID);
}
//var_dump($dados);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wIDth=device-wIDth, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<br>
<a href="index.php"><button>Listar</button></a>
<a href="cad.php"><button>Novo</button></a>
<br><br>
<form action="acao.php" method="post">
    <input readonly  type="text" name="ID" ID="ID" value="<?php if ($acao == "editar") echo $dados['ID']; else echo 0; ?>"><br>
    <input required=true   type="text" name="DESCRICAO" ID="DESCRICAO" value="<?php if ($acao == "editar") echo $dados['DESCRICAO']; ?>"><br>
    <br><button type="submit" name="acao" ID="acao" value="salvar">Salvar</button>
</form>
</body>
</html>
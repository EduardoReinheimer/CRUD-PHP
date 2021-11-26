<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    
    $pdo = Conexao::getInstance();

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $_POST['acao'];

    if ($acao == 'excluir'){
        $stmt = $pdo->prepare('DELETE FROM info WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $id = $_GET['id'];
        $stmt->execute();
        header('location:index.php');
    }

    if ($acao == 'salvar'){
        $stmt = $pdo->prepare('INSERT INTO info (descricao) VALUES(:descricao)');
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $descricao = $_POST['descricao'];
        
        $stmt->execute();

        header("location:index.php");
    }
?>


<?php

    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    
    $pdo = Conexao::getInstance();

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $ID = isset($_GET['ID']) ? $_GET['ID'] : 0;
        excluir($ID);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $ID = isset($_POST['ID']) ? $_POST['ID'] : 0;
        $DESCRICAO = isset($_POST['DESCRICAO']) ? $_POST['DESCRICAO'] : "";
        if ($ID == 0)
            inserir($ID);
        else
            editar($ID);
    }

    // Métodos para cada operação
    function inserir($ID){
        $dados = dadosForm();
        //var_dump($dados);       
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO info (DESCRICAO) VALUES(:DESCRICAO)');
        $stmt->bindParam(':DESCRICAO', $_POST['DESCRICAO'], PDO::PARAM_STR);
        $DESCRICAO = $_POST['DESCRICAO'];
        
        $stmt->execute();

        header("location:index.php");
        
    }

    function editar($ID){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE info SET DESCRICAO = :DESCRICAO WHERE ID = :ID');
        $stmt->bindParam(':DESCRICAO', $_POST['DESCRICAO'], PDO::PARAM_STR);
        $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
        $DESCRICAO = $dados['DESCRICAO'];
        $ID = $dados['ID'];
        $stmt->execute();
        header("location:index.php");
    }

    function excluir($ID){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE FROM info WHERE ID = :ID');
        $stmt->bindParam(':ID', $ID);
        $ID = $ID;
        $stmt->execute();
        header('location:index.php');
    }


    function dadosForm(){
        $dados = array();
        $dados['ID'] = $_POST['ID'];
        $dados['DESCRICAO'] = $_POST['DESCRICAO'];
        return $dados;
    }

     // Busca um item pelo código no BD
     function buscarDados($ID){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM info WHERE ID = $ID");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['ID'] = $linha['ID'];
            $dados['DESCRICAO'] = $linha['DESCRICAO'];
        }
        //var_dump($dados);
        return $dados;
    }

    ?>

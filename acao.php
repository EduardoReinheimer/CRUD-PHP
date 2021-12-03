<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    
    $pdo = Conexao::getInstance();

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : 0;
        excluir($codigo);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : "";
        if ($codigo == 0)
            inserir($codigo);
        else
            editar($codigo);
    }

    // Métodos para cada operação
    function inserir($codigo){
        $dados = dadosForm();
        //var_dump($dados);
        
        $pdo = Conexao::getInstance();

        $stmt = $pdo->prepare('INSERT INTO info (descricao) VALUES(:descricao)');
        $stmt->bindParam(':descricao', $_POST['descricao'], PDO::PARAM_STR);
        $descricao = $_POST['descricao'];
        
        $stmt->execute();

        header("location:index.php");
        
    }

    function editar($id){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE info SET descricao = :descricao WHERE id = :codigo');
        $stmt->bindParam(':descricao', $_POST['descricao'], PDO::PARAM_STR);
        $stmt->bindParam(':codigo', $id, PDO::PARAM_INT);
        $descricao = $dados['descricao'];
        $codigo = $dados['ID'];
        $stmt->execute();
        header("location:index.php");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE FROM info WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $id = $id;
        $stmt->execute();
        header('location:index.php');
    }


    function dadosForm(){
        $dados = array();
        $dados['ID'] = $_POST['codigo'];
        $dados['DESCRICAO'] = $_POST['descricao'];
        return $dados;
    }

     // Busca um item pelo código no BD
     function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM info WHERE ID = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['ID'] = $linha['ID'];
            $dados['DESCRICAO'] = $linha['DESCRICAO'];
        }
        //var_dump($dados);
        return $dados;
    }

    ?>

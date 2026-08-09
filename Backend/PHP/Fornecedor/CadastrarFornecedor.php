
<?php 
    // Referênciando o arquivo onde se encontra á conexão ao banco de dados.
    require_once "ConexaoBanco.php";

    // Criando um objeto 'Banco', com a classe 'Conexao' do arquivo ConexaoBanco.php
    $Banco = new Conexao();

    // Obtendo a conexao ao banco de dados de fato, pelo método Conectar da classe ConexaoBanco.
    $Conexao = $Banco->Conectar();

    // Pegando dos dados enviado pelo javascript e armazena - las nas devidas variaveis.
    $CodFornecedor = $_GET["CodFornecedor"];
    $RazaoSocial  = $_GET["RazaoSocial"];
    $PaisOrigem = $_GET["PaisOrigem"];

    // Preparando a procedure para receber os dados e armazenar tudo em uma variavel.
    $Instrucao = $Conexao->prepare ("
        Call SPCadastrarFornecedor(?,?,?)
    ");

    // Adicionando os parametros nescessário na procedure.
    $Instrucao->bind_param(
        "iss", // --> Indica que é um inteiro e duas Strings.
        $CodFornecedor,
        $RazaoSocial,
        $PaisOrigem
    );

    $Instrucao->execute(); // --> Enviando e executando a procedure no banco.

    // Coletar dados e/ou resultado enviado pelo banco.
    $RespResult = $Instrucao->get_result();

    // Aqui converte o resultado em uma linha de verificação de Certo ou erro.
    $Verificado = $RespResult->fetch_assoc();

    // Verificar se os dados da variavel 'Retorno', no MySql é 'SUCESSO'.
    if($Verificado["Retorno"] == "SUCESSO") {
        echo "Cadastrou";
    }
    else {
        echo "FALHOU";
    }

    $Instrucao->close(); // --> Fechar a varivel '$Instrucao'.
    $Conexao->close(); // --> Fechar a varivel '$Conexao'.
?>

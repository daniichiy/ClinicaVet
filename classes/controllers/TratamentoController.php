<?php

class TratamentoController{

    function ListarProntuarios($codAnimal){
        $config = require __DIR__ . '/../../config/database.php';

        $servidor = $config['servidor'];
        $usuario = $config['usuario'];
        $senha = $config['senha'];

        $lista = [];

        try{
            $pdo = new PDO($servidor, $usuario, $senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cSQL = $pdo->prepare('SELECT cod_animal, cod_tratamento, data_tratamento, descricao_observacao FROM prontuario WHERE cod_animal = :codAnimal');
            $cSQL->bindParam('codAnimal', $codAnimal);
            $cSQL->execute();

            while($dados = $cSQL->fetch(PDO::FETCH_ASSOC)){
                $codAnimal = $dados['cod_tratamento'];
                $codTratamento = $dados['cod_tratamento'];
                $dataTratamento = $dados['data_tratamento'];
                $descricaoObs = $dados['descricao_observacao'];

                $cSQL_Tratamento = $pdo->prepare('SELECT nome_tratamento, descricao_tratamento FROM tratamento WHERE cod_tratamento = :codigo');
                $cSQL_Tratamento->bindParam('codigo', $codTratamento);
                $cSQL_Tratamento->execute();

                $dadosTratamento = $cSQL_Tratamento->fetch(PDO::FETCH_ASSOC);
                $nomeTratamento = $dadosTratamento['nome_tratamento'];
                $descricaoTratamento = $dadosTratamento['descricao_tratamento'];

                $tratamento = new Tratamento($codTratamento, $nomeTratamento, $descricaoTratamento);

                $prontuario = new Prontuario(null, $tratamento, $dataTratamento, $descricaoObs);
                
                array_push($lista, $prontuario);
            }
            $pdo = null;

        }catch (PDOException $ex){
            echo 'Erro: ' . $ex->getMessage();
        }

        return $lista;
    }

    function listarTratamentos() {
        $config = require __DIR__ . '/../../config/database.php';

        $servidor = $config['servidor'];
        $usuario = $config['usuario'];
        $senha = $config['senha'];
        $lista = [];

        try{
            $pdo = new PDO($servidor, $usuario, $senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cSQL = $pdo->prepare('SELECT cod_tratamento, nome_tratamento, descricao_tratamento FROM tratamento');
            $cSQL->execute();
            $dados = $cSQL->fetchAll(PDO::FETCH_ASSOC);

            for($i = 0; $i < count($dados); $i++){
                array_push($lista, $dados[$i]);
            }
            $pdo = null;

        }catch (PDOException $ex){
            echo 'Erro: ' . $ex->getMessage();
        }

        return $lista;
    }

    function BuscarPorId($codTratamento): Tratamento {
        $config = require __DIR__ . '/../../config/database.php';

        try {
            $pdo = new PDO(
                $config['servidor'],
                $config['usuario'],
                $config['senha']
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "
                SELECT cod_tratamento, nome_tratamento, descricao_tratamento
                FROM tratamento
                WHERE cod_tratamento = :id
                LIMIT 1
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $codTratamento, PDO::PARAM_INT);
            $stmt->execute();

            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$dados) {
                throw new Exception('Tratamento não encontrado');
            }

            return new Tratamento(
                $dados['cod_tratamento'],
                $dados['nome_tratamento'],
                $dados['descricao_tratamento']
            );

        } catch (PDOException $e) {
            throw new Exception('Erro ao buscar tratamento');
        }
    }
    
}
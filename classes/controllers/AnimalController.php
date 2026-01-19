<?php

class AnimalController {
    function Listar(){
        $config = require __DIR__ . '/../../config/database.php';

        $servidor = $config['servidor'];
        $usuario = $config['usuario'];
        $senha = $config['senha'];

        $lista = [];

        try{
            $pdo = new PDO($servidor, $usuario, $senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cSQL = $pdo->prepare('SELECT cod_animal, nome_animal, cod_especie FROM animal');
            $cSQL->execute();

            while ($dados = $cSQL->fetch(PDO::FETCH_ASSOC)){
                $codigo = $dados['cod_animal'];
                $nome = $dados['nome_animal'];
                $codigoEspecie = $dados['cod_especie'];

                $cSQL_Especie = $pdo->prepare('SELECT nome_especie FROM especie WHERE cod_especie = :codigo');
                $cSQL_Especie->bindParam('codigo', $codigoEspecie);
                $cSQL_Especie->execute();

                $dadosEspecie = $cSQL_Especie->fetch(PDO::FETCH_ASSOC);
                $nomeEspecie = $dadosEspecie['nome_especie'];

                $especie = new Especie($codigoEspecie, $nomeEspecie);

                $animal = new Animal($codigo, $nome, $especie);
                array_push($lista, $animal);
            }
            $pdo = null;

        } catch(PDOException $ex){
            echo 'Erro: ' . $ex->getMessage();
        }
        return $lista;
    }

    function BuscarPeloNome($nome){
        $config = require __DIR__ . '/../../config/database.php';

        $servidor = $config['servidor'];
        $usuario = $config['usuario'];
        $senha = $config['senha'];

        $lista = [];

        try{
            $pdo = new PDO($servidor, $usuario, $senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cSQL = $pdo->prepare('SELECT cod_animal, nome_animal, cod_especie FROM animal WHERE nome_animal = :nome');
            $cSQL->bindParam('nome', $nome);
            $cSQL->execute();

            while ($dados = $cSQL->fetch(PDO::FETCH_ASSOC)){
                $codigo = $dados['cod_animal'];
                $nome = $dados['nome_animal'];
                $codigoEspecie = $dados['cod_especie'];

                $cSQL_Especie = $pdo->prepare('SELECT nome_especie FROM especie WHERE cod_especie = :codigo');
                $cSQL_Especie->bindParam('codigo', $codigoEspecie);
                $cSQL_Especie->execute();

                $dadosEspecie = $cSQL_Especie->fetch(PDO::FETCH_ASSOC);
                $nomeEspecie = $dadosEspecie['nome_especie'];

                $especie = new Especie($codigoEspecie, $nomeEspecie);

                $animal = new Animal($codigo, $nome, $especie);
                array_push($lista, $animal);
            }
            $pdo = null;

        } catch(PDOException $ex){
            echo 'Erro: ' . $ex->getMessage();
        }
        return $lista;
    }

    function BuscarNome($cod){
        $config = require __DIR__ . '/../../config/database.php';

        $servidor = $config['servidor'];
        $usuario = $config['usuario'];
        $senha = $config['senha'];

        try{
            $pdo = new PDO($servidor, $usuario, $senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cSQL = $pdo->prepare('SELECT nome_animal FROM animal WHERE cod_animal = :codigo');
            $cSQL->bindParam('codigo', $cod);
            $cSQL->execute();
            $nome = $cSQL->fetch(PDO::FETCH_ASSOC);

        } catch(PDOException $ex){
            echo 'Erro: ' . $ex->getMessage();
        }
        $pdo = null;

        return($nome['nome_animal']);
    }

    function BuscarPorId($codAnimal): Animal {
        $config = require __DIR__ . '/../../config/database.php';

        try {
            $pdo = new PDO(
                $config['servidor'],
                $config['usuario'],
                $config['senha']
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "
                SELECT a.cod_animal, a.nome_animal,
                       e.cod_especie, e.nome_especie
                FROM animal a
                INNER JOIN especie e ON e.cod_especie = a.cod_especie
                WHERE a.cod_animal = :id
                LIMIT 1
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $codAnimal, PDO::PARAM_INT);
            $stmt->execute();

            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$dados) {
                throw new Exception('Animal não encontrado');
            }

            $especie = new Especie(
                $dados['cod_especie'],
                $dados['nome_especie']
            );

            $animal = new Animal(
                $dados['cod_animal'],
                $dados['nome_animal'],
                $especie
            );

            return $animal;
        } catch (PDOException $e) {
            throw new Exception('Erro ao buscar animal');
        }
    }
}

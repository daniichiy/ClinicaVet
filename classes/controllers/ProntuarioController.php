<?php

class ProntuarioController {

    public function SalvarProntuario($codAnimal, $codTratamento, $data, $descricaoObs) {
        $config = require __DIR__ . '/../../config/database.php';

        if (!$codTratamento || !$data) {
            die('Preencha data e tratamento');
        }

        try {
            $pdo = new PDO(
                $config['servidor'],
                $config['usuario'],
                $config['senha']
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $animalController = new AnimalController();
            $animal = $animalController->BuscarPorId($codAnimal);

            $tratamentoController = new TratamentoController();
            $tratamento = $tratamentoController->BuscarPorId($codTratamento);
            
            $prontuario = new Prontuario(
                $animal,
                $tratamento,
                $data,
                $descricaoObs
            );

            $sql = "
                INSERT INTO prontuario
                (cod_animal, cod_tratamento, data_tratamento, descricao_observacao)
                VALUES
                (:animal, :tratamento, :data, :obs)
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':animal', $prontuario->Animal->Codigo, PDO::PARAM_INT);
            $stmt->bindValue(':tratamento', $prontuario->Tratamento->Codigo, PDO::PARAM_INT);
            $stmt->bindValue(':data', $prontuario->DataTratamento);
            $stmt->bindValue(':obs', $prontuario->Descricao);

            $stmt->execute();

            header("Location: atendimento.php?cod={$prontuario->Animal->Codigo}");
            exit;

        } catch (PDOException $e) {
            die('Erro ao salvar prontuário: ' . $e);
        }
    }
}

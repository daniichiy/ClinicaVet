<?php

class ProntuarioView {

    public function ExibirHistorico(array $historico) {
        foreach ($historico as $item) {
            echo '<tr>';
            echo '<td>' . date('d/m/Y', strtotime($item['data_tratamento'])) . '</td>';
            echo '<td>' . htmlspecialchars($item['nome_tratamento']) . '</td>';
            echo '<td>' . htmlspecialchars($item['descricao_tratamento']) . '</td>';
            echo '</tr>';
        }
    }
}


<?php

class TratamentoView
{
    function ExibirHistorico($codAnimal)
    {
        $tratamentoController = new TratamentoController();
        $listaProntuario = $tratamentoController->ListarProntuarios($codAnimal);

        if (!empty($listaProntuario)) {
            for ($i = 0; $i < count($listaProntuario); $i++) {
                echo '<tr>
                        <td class="data">' . date_format(date_create($listaProntuario[$i]->DataTratamento), 'd/m/Y h:m') . '</td>
                        <td>' . $listaProntuario[$i]->Tratamento->Nome . '</td>
                        <td> ' . $listaProntuario[$i]->Descricao . '</td>
                     </tr>';
            }
        } else {
            echo "<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                 </tr>";
        }
    }

    function ExibirTratamentos(){
        $tratamentoController = new TratamentoController();
        $listaTratamento = $tratamentoController->listarTratamentos();

        if(!empty($listaTratamento)){
            for($i = 0; $i < count($listaTratamento); $i++){
                echo "<option>{$listaTratamento[$i]}</option>";
            }
        }
    }
}

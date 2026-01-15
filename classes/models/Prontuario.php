<?php

class Prontuario {
    public $Animal;
    public $Tratamento;
    public $DataTratamento;
    public $Descricao;

    function __construct($animal = null, Tratamento $tratamento = null, $dataTratamento = null, $descricao = null) {
        $this->Animal = $animal;
        $this->DataTratamento = $dataTratamento;
        $this->Descricao = $descricao;

        if($tratamento != null){
            $this->Tratamento = $tratamento;
        } else{
            $this->Tratamento = new Tratamento();
        }
    }
    
}
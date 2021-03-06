<?php
    // Funções para tratamento de dados

    function unformatCpf($cpf) {
        $pattern = '/\D/i';
        $replacement = '';
        return preg_replace($pattern, $replacement, $cpf);
    }

    function formatCpf($cpf){
        $cpf = preg_replace("/[^0-9]/", "", $cpf);

        $firstBlock = substr($cpf,0,3);
        $secondBlock = substr($cpf,3,3);
        $thirdBlock = substr($cpf,6,3);
        $lastBlock = substr($cpf,-2);
        $cpfFormated = $firstBlock.".".$secondBlock.".".$thirdBlock."-".$lastBlock;

        return $cpfFormated;
    }

    function unformatMoneyValue($value) {
        $value = str_replace(".", "", $value);
        $value = str_replace(",", ".", $value);
        $value = str_replace("R$ ", "", $value);
        return $value;
    }

    function formatMoneyValue($value) {
        return 'R$ ' . number_format($value, 2, ',', '.');
    }

    function formatDate($date) {
        return $date;
    }

    function calcTotal($unityValue, $amount) {
        return formatMoneyValue(floatval($unityValue) * intval($amount));
    }

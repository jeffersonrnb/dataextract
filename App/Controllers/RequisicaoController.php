<?php

if($_REQUEST['action'] == 'extrair' && !empty($_REQUEST['data_url'])) {
    $dados = RequisicaoController::extrair();

}

class RequisicaoController
{
    public function extrair()
    {
        $url = $_REQUEST['data_url'];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $retorno = curl_exec($ch);

        curl_close($ch);

        return $retorno;
    }
}

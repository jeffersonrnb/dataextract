<?php

include('../Models/Conexao.php');
include('../Models/Secao.php');
include('../Models/Divisao.php');
include('../Models/Grupo.php');
include('../Models/Classe.php');
include('../Models/Subclasse.php');
include('SecaoController.php');

if($_REQUEST['action'] == 'extrair' && !empty($_REQUEST['data_url'])) {
    $dados = RequisicaoController::extrair();

    $secao = new Secao($dados);
    $secao_id = Secao::save($secao);

    $divisao = new Divisao($dados);
    $divisao->secao_id = $secao_id;
    $divisao_id = Divisao::save($divisao);

    $grupo = new Grupo($dados);
    $grupo->divisao_id = $divisao_id;
    $grupo_id = Grupo::save($grupo);

    $classe = new Classe($dados);
    $classe->grupo_id = $grupo_id;
    $classe_id = Classe::save($classe);

    $subclasse = new Subclasse($dados);
    $subclasse->classe_id = $classe_id;
    $subclasse_id = Subclasse::save($subclasse);
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

        $DOM = new DOMDocument;
        @$DOM->loadHTML($retorno);
        $items = $DOM->getElementsByTagName('td');

        return $items;
    }
}

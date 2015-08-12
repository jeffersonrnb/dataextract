<?php
include('../Models/Conexao.php');
include('../Models/Secao.php');
include('../Models/Divisao.php');
include('../Models/Grupo.php');
include('../Models/Classe.php');
include('../Models/Subclasse.php');

$dados = RequisicaoController::extract();

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
    public static function getSecoes($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $retorno = curl_exec($ch);

        curl_close($ch);

        return static::getLinks($retorno);
    }

    public static function getLinks($source)
    {
        $DOM = new DOMDocument;
        @$DOM->loadHTML($source);

        return $DOM->getElementsByTagName('a');
    }

    public function extract()
    {
        $dominio = 'http://www.cnae.ibge.gov.br/';
        $url = "http://www.cnae.ibge.gov.br/estrutura.asp?TabelaBusca=CNAE_202@CNAE%202.2%20-%20Subclasses@0@cnaefiscal@0";

        $chSecoes = array();

        $secoes = static::getSecoes($url);

        $mh = curl_multi_init();

        foreach ($secoes as $i => $secao) {
            if(strpos($secao->getAttribute('href'), 'secao.asp?') !== false) {
                $chSecoes[$i] = curl_init();

                $url = str_replace(' ', '%20', $dominio . $secao->getAttribute('href'));
                curl_setopt($chSecoes[$i], CURLOPT_URL, $url);
                curl_setopt($chSecoes[$i], CURLOPT_RETURNTRANSFER, true);

                curl_multi_add_handle($mh, $chSecoes[$i]);
            }
        }

        static::executeHandles($mh);

        $secoesContent = array();

        foreach ($chSecoes as $i => $chSecao) {
            $secoesContent[$i] = curl_multi_getcontent($chSecao);

            //close the handles
            curl_multi_remove_handle($mh, $chSecao);
        }

        $chDivisoes = array();

        foreach ($secoesContent as $i => $secaoContent) {
            $divisoes[$i] = static::getLinks($secaoContent);

            foreach ($divisoes as $j => $divisoesSecao) {
                foreach ($divisoesSecao as $k => $divisao) {
                    if(strpos($divisao->getAttribute('href'), 'divisao.asp?') !== false) {
                        $chDivisoes[$j] = curl_init();

                        $url = str_replace(' ', '%20', $dominio . $divisao->getAttribute('href'));
                        curl_setopt($chDivisoes[$j], CURLOPT_URL, $url);
                        curl_setopt($chDivisoes[$j], CURLOPT_RETURNTRANSFER, true);

                        curl_multi_add_handle($mh, $chDivisoes[$j]);
                    }
                }
            }
        }

        static::executeHandles($mh);

        $divisoesContent = array();

        foreach ($chDivisoes as $i => $chDivisao) {
            $divisoesContent[$i] = curl_multi_getcontent($chDivisao);
            var_dump($divisoesContent[$i]);

            //close the handles
            curl_multi_remove_handle($mh, $chDivisao);
        }

        curl_multi_close($mh);
    }

    public static function executeHandles(&$mh)
    {
        $active = null;
        //execute the handles
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($active && $mrc == CURLM_OK) {
            if (curl_multi_select($mh) != -1) {
                usleep(100);
            }

            do {
                $mrc = curl_multi_exec($mh, $active);
            } while ($mrc == CURLM_CALL_MULTI_PERFORM);
        }
    }
}

<?php
class Divisao extends Conexao
{
    public static $tabela = 'divisoes';

    public $id;
    public $secao_id;
    public $cnae_id;
    public $descricao;

    public function __construct($dados = array())
    {
        if(!empty($dados)) {
            $this->cnae_id = $dados->item(20)->textContent;
            $this->descricao = $dados->item(21)->textContent;
        }
    }

    public static function insert($divisao)
    {
        $pdo = static::connect();
        $result = $pdo->prepare('INSERT INTO divisoes (secao_id, cnae_id, descricao, criado_em, atualizado_em)
            VALUES (:secao_id, :cnae_id, :descricao, NOW(), NOW())');
        $result->execute((array)$divisao);
        return $pdo->lastInsertId();
    }
}

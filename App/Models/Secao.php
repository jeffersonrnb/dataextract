<?php
class Secao extends Conexao
{
    public static $tabela = 'secoes';

    public $id;
    public $cnae_id;
    public $descricao;

    public function __construct($dados = array())
    {
        if(!empty($dados)) {
            $this->cnae_id = $dados->item(16)->textContent;
            $this->descricao = $dados->item(17)->textContent;
        }
    }

    public static function insert($secao)
    {
        $pdo = static::connect();
        $result = $pdo->prepare('INSERT INTO secoes (cnae_id, descricao, criado_em, atualizado_em)
            VALUES (:cnae_id, :descricao, NOW(), NOW())');
        $result->execute((array)$secao);
        return $pdo->lastInsertId();
    }
}

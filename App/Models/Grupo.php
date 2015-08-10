<?php
class Grupo extends Conexao
{
    public static $tabela = 'grupos';

    public $id;
    public $divisao_id;
    public $cnae_id;
    public $descricao;

    public function __construct($dados = array())
    {
        if(!empty($dados)) {
            $this->cnae_id = $dados->item(24)->textContent;
            $this->descricao = $dados->item(25)->textContent;
        }
    }

    public static function insert($grupo)
    {
        $pdo = static::connect();
        $result = $pdo->prepare('INSERT INTO grupos (divisao_id, cnae_id, descricao, criado_em, atualizado_em)
            VALUES (:divisao_id, :cnae_id, :descricao, NOW(), NOW())');
        $result->execute((array)$grupo);
        return $pdo->lastInsertId();
    }
}

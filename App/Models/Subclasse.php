<?php
class Subclasse extends Conexao
{
    public static $tabela = 'subclasses';

    public $id;
    public $classe_id;
    public $cnae_id;
    public $descricao;

    public function __construct($dados = array())
    {
        if(!empty($dados)) {
            $this->cnae_id = $dados->item(32)->textContent;
            $this->descricao = $dados->item(33)->textContent;
        }
    }

    public static function insert($subclasse)
    {
        $pdo = static::connect();
        $result = $pdo->prepare('INSERT INTO subclasses (classe_id, cnae_id, descricao, criado_em, atualizado_em)
            VALUES (:classe_id, :cnae_id, :descricao, NOW(), NOW())');
        $result->execute((array)$subclasse);
        return $pdo->lastInsertId();
    }
}

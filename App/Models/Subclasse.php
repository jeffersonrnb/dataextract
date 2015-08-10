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

    public static function allByClass($id)
    {
        $pdo = static::connect();
        $result = $pdo->prepare('SELECT * FROM subclasses WHERE classe_id = :id');
        $result->bindValue(':id', $id);
        $result->execute();
        $result->setFetchMode(\PDO::FETCH_CLASS, get_class());
        return $result->fetchAll();
    }

    public static function find($id)
    {
        $pdo = static::connect();
        $result = $pdo->prepare('SELECT sub.cnae_id as sub_id, sub.descricao as sub_descricao,
            cl.cnae_id as cl_id, cl.descricao as cl_descricao, gr.cnae_id as gr_id,
            gr.descricao as gr_descricao, dv.cnae_id as dv_id, dv.descricao as dv_descricao,
            sc.cnae_id as sc_id, sc.descricao as sc_descricao FROM subclasses sub
            inner join classes cl on sub.classe_id = cl.id
            inner join grupos gr on cl.grupo_id = gr.id
            inner join divisoes dv on gr.divisao_id = dv.id
            inner join secoes sc on dv.secao_id = sc.id where sub.id = :id');
        $result->bindValue(':id', $id);
        $result->execute();
        $result->setFetchMode(\PDO::FETCH_CLASS, get_class());
        return $result->fetch();
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

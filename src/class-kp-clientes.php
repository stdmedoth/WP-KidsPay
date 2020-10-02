<?php

class KidsPayClientes extends KidsPayForms{

  function __construct(){
    $this->table = 'clientes';
  }

  public function get_loginid(){
    global $wpdb;
    return $wpdb->get_results('SELECT id_cliente FROM clientes WHERE id_cliente = ' . get_current_user_id());
  }

  public function insert_loginid(){
    global $wpdb;
    $login_atual = get_userdata(get_current_user_id());
    $login_user = array(
      'id_cliente' => $login_atual->id,
      'nome' => $login_atual->user_login
    );
    return $wpdb->insert('clientes',$login_user);
  }

  public function get_alunoid_pnome($var){
    global $wpdb;
    $res = $wpdb->get_results($wpdb->prepare('SELECT a.id_aluno FROM alunos as a INNER JOIN clientes as c on a.id_cliente = c.id_cliente WHERE c.id_cliente = ' . get_current_user_id() . " and a.nome = '$var'"), ARRAY_A);

    if($res and $res[0]['id_aluno']){
      return $res[0]['id_aluno'];
    }
    else{
      $form = new KidsPayForms();
      $form->PrintErro('Não foi possível encontrar id do aluno');
      $form->PrintErro($wpdb->print_error());
    }
  }

  public function getCredito($aluno = 1){
    global $wpdb;

    $res = $wpdb->get_results($wpdb->prepare('SELECT SUM(valor) FROM credito_clientes WHERE id_cliente = ' . get_current_user_id() . " and id_aluno = '$aluno'"), ARRAY_A);

    if($res and $res[0]['SUM(valor)']){

      echo $res[0]['SUM(valor)'];

    }else{
      $form = new KidsPayForms();
      $form->PrintErro('Não foi possível calcular saldo de créditos');
      $form->PrintErro($wpdb->print_error());
    }
  }

  public function get_alunos(){
    global $wpdb;
    return $wpdb->get_results('SELECT a.nome FROM alunos as a INNER JOIN clientes as c on a.id_cliente = c.id_cliente WHERE c.id_cliente = ' . get_current_user_id(), ARRAY_A);
  }
}

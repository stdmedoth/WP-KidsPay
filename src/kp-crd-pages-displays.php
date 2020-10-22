<?php

function kidspay_creditos_cmp_page_display(){
  if(isset($_REQUEST['atualizando'])){
    global $wpdb;
    $cliente = new KidsPayClientes();
    if(isset($_REQUEST['atualizando'])){
      if(isset($_REQUEST['aluno'])){
        $aluno = $_REQUEST['aluno'];
        if(isset($_REQUEST['valor'])){
          if(!$_REQUEST['valor']){
            $cliente->PrintErro('Valor inválido');
          }else{
            $res = $wpdb->insert('credito_clientes', array(
              'dtpagamento' => date('Y-m-d H:i'),
              'valor' => $_REQUEST['valor'],
              'situacao' => 'A',
              'id_cliente' =>  get_current_user_id(),
              'id_aluno' => $aluno
            ));

            if(!$res){
              die($wpdb->print_error());
            }else{
              $alunos = $cliente->get_alunos($aluno);

              $res = $wpdb->update('alunos',
                array('saldo' => $alunos[0]['credito'] - $alunos[0]['gastos']),
                array('id_aluno' => $aluno)
              );

              $cliente->PrintOk('Recarregado com sucesso');
            }
          }
        }
      }else{
        $cliente->PrintErro('Não foi possível identificar aluno');
      }
    }
  }
  ?>
  <div class='wrap'>
    <h1 class='wp-heading-inline'>Recarregar Créditos</h1>
    <hr class='wp-head-end'>

    <?php
      comprar_creditos_html();
    ?>
  <?php
}


function kidspay_creditos_estorno_page_display(){
  ?>
  <div class='wrap'>
    <h1 class='wp-heading-inline'>Estornar Créditos</h1>
    <hr class='wp-head-end'>
  <?php
    global $wpdb;
    $cliente = new KidsPayClientes();
    if(isset($_REQUEST['action'])){
      $action = $_REQUEST['action'];
      switch ($action) {
        case 'est':
          if(isset($_REQUEST['id']))
            $id = $_REQUEST['id'];
          else{
            $cliente->Print("Requisição Inválida");
            break;
          }
          $creditos = $cliente->getCredHist($id);
          if($creditos){
            $aluno = $creditos[0]['id_aluno'];
            $alunos = $cliente->get_alunos($aluno);
            if($creditos[0]['valor'] > $alunos[0]['saldo']){
              $cliente->PrintErro("O saldo já foi usado");
              break;
            }

          }else{
            break;
          }
          $wpdb->update('credito_clientes',
          array('situacao' => 'E'),
          array('id_credito_cliente' => $id));
          $alunos = $cliente->get_alunos($aluno);

          $wpdb->update('alunos',
          array('saldo' => $alunos[0]['saldo']),
          array('id_aluno' => $id));
          break;

        case 'ativ':
          if(isset($_REQUEST['id']))
            $id = $_REQUEST['id'];
          else{
            $cliente->Print("Requisição Inválida");
            break;
          }
          $creditos = $cliente->getCredHist($id);
          if($creditos){
            $aluno = $creditos[0]['id_aluno'];
            $alunos = $cliente->get_alunos($aluno);
          }else{
            break;
          }

          $wpdb->update('credito_clientes',
          array('situacao' => 'A'),
          array('id_credito_cliente' => $id));

          $alunos = $cliente->get_alunos($aluno);

          $wpdb->update('alunos',
          array('saldo' => $alunos[0]['saldo']),
          array('id_aluno' => $id));
          break;

        default:
          // code...
          break;
      }
    }
    estornar_creditos_html();
}

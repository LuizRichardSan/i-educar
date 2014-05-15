<?php
/**
 * i-Educar - Sistema de gest�o escolar
 *
 * Copyright (C) 2006  Prefeitura Municipal de Itaja�
 *                     <ctima@itajai.sc.gov.br>
 *
 * Este programa � software livre; voc� pode redistribu�-lo e/ou modific�-lo
 * sob os termos da Licen�a P�blica Geral GNU conforme publicada pela Free
 * Software Foundation; tanto a vers�o 2 da Licen�a, como (a seu crit�rio)
 * qualquer vers�o posterior.
 *
 * Este programa � distribu��do na expectativa de que seja �til, por�m, SEM
 * NENHUMA GARANTIA; nem mesmo a garantia impl��cita de COMERCIABILIDADE OU
 * ADEQUA��O A UMA FINALIDADE ESPEC�FICA. Consulte a Licen�a P�blica Geral
 * do GNU para mais detalhes.
 *
 * Voc� deve ter recebido uma c�pia da Licen�a P�blica Geral do GNU junto
 * com este programa; se n�o, escreva para a Free Software Foundation, Inc., no
 * endere�o 59 Temple Street, Suite 330, Boston, MA 02111-1307 USA.
 *
 * @author    Lucas Schmoeller da Silva <lucas@portabilis.com.br>
 * @category  i-Educar
 * @license   @@license@@
 * @package   Module
 * @since     07/2013
 * @version   $Id$
 */

require_once 'include/pmieducar/geral.inc.php';

/**
 * clsModulesMotorista class.
 * 
 * @author    Lucas Schmoeller da Silva <lucas@portabilis.com.br>
 * @category  i-Educar
 * @license   @@license@@
 * @package   Module
 * @since     07/2013
 * @version   @@package_version@@
 */
class clsModulesMotorista
{
  var $cod_motorista;
  var $ref_idpes;
  var $cnh;
  var $tipo_cnh;
  var $dt_habilitacao;
  var $vencimento_cnh;  
  var $ref_cod_empresa_transporte_escolar;
  var $observacao;
  /**
   * Armazena o total de resultados obtidos na �ltima chamada ao m�todo lista().
   * @var int
   */
  var $_total;

  /**
   * Nome do schema.
   * @var string
   */
  var $_schema;

  /**
   * Nome da tabela.
   * @var string
   */
  var $_tabela;

  /**
   * Lista separada por v�rgula, com os campos que devem ser selecionados na
   * pr�xima chamado ao m�todo lista().
   * @var string
   */
  var $_campos_lista;

  /**
   * Lista com todos os campos da tabela separados por v�rgula, padr�o para
   * sele��o no m�todo lista.
   * @var string
   */
  var $_todos_campos;

  /**
   * Valor que define a quantidade de registros a ser retornada pelo m�todo lista().
   * @var int
   */
  var $_limite_quantidade;

  /**
   * Define o valor de offset no retorno dos registros no m�todo lista().
   * @var int
   */
  var $_limite_offset;

  /**
   * Define o campo para ser usado como padr�o de ordena��o no m�todo lista().
   * @var string
   */
  var $_campo_order_by;

  /**
   * Construtor.
   */
  function clsModulesMotorista( $cod_motorista = NULL, $ref_idpes = NULL, $cnh = NULL,
  $tipo_cnh = NULL, $dt_habilitacao = NULL, $vencimento_cnh = NULL,  $ref_cod_empresa_transporte_escolar = NULL,
   $observacao = NULL)
  {
    $db = new clsBanco();
    $this->_schema = "modules.";
    $this->_tabela = "{$this->_schema}motorista";

    $this->_campos_lista = $this->_todos_campos = " cod_motorista, ref_idpes, cnh, tipo_cnh, dt_habilitacao, vencimento_cnh, ref_cod_empresa_transporte_escolar, 
       observacao"; 

    if (is_numeric($cod_motorista)) {
      $this->cod_motorista = $cod_motorista;
    }

    if (is_numeric($ref_idpes)) {
      $this->ref_idpes = $ref_idpes;
    }

    if (is_string($cnh)) {
      $this->cnh = $cnh;
    }

    if (is_string($tipo_cnh)) {
      $this->tipo_cnh = $tipo_cnh;
    }

    if (is_string($dt_habilitacao)) {
      $this->dt_habilitacao = $dt_habilitacao;
    }

    if (is_string($vencimento_cnh)) {
      $this->vencimento_cnh = $vencimento_cnh;
    }

    if (is_numeric($ref_cod_empresa_transporte_escolar)) {
      $this->ref_cod_empresa_transporte_escolar = $ref_cod_empresa_transporte_escolar;
    }

    if (is_string($observacao)) {
      $this->observacao = $observacao;
    }

  }

  /**
   * Cria um novo registro.
   * @return bool
   */
  function cadastra()
  {

    if (is_numeric($this->ref_cod_empresa_transporte_escolar)
      && is_numeric($this->ref_idpes) )
    {

      $db = new clsBanco();
      $campos  = '';
      $valores = '';
      $gruda   = '';

    if (is_numeric($this->cod_motorista)) {
        $campos .= "{$gruda}cod_motorista";
        $valores .= "{$gruda}'{$this->cod_motorista}'";
        $gruda = ", ";
    }

    if (is_numeric($this->ref_idpes)) {
        $campos .= "{$gruda}ref_idpes";
        $valores .= "{$gruda}'{$this->ref_idpes}'";
        $gruda = ", ";
    }

    if (is_string($this->cnh)) {
        $campos .= "{$gruda}cnh";
        $valores .= "{$gruda}'{$this->cnh}'";
        $gruda = ", ";
    }

    if (is_string($this->tipo_cnh)) {
        $campos .= "{$gruda}tipo_cnh";
        $valores .= "{$gruda}'{$this->tipo_cnh}'";
        $gruda = ", ";
    }

    if (is_string($this->dt_habilitacao) && trim($this->dt_habilitacao)!='') {
        $campos .= "{$gruda}dt_habilitacao";
        $valores .= "{$gruda}'{$this->dt_habilitacao}'";
        $gruda = ", ";
    }

    if (is_string($this->vencimento_cnh)  && trim($this->vencimento_cnh)!='') {
        $campos .= "{$gruda}vencimento_cnh";
        $valores .= "{$gruda}'{$this->vencimento_cnh}'";
        $gruda = ", ";
    }

    if (is_numeric($this->ref_cod_empresa_transporte_escolar)) {
        $campos .= "{$gruda}ref_cod_empresa_transporte_escolar";
        $valores .= "{$gruda}'{$this->ref_cod_empresa_transporte_escolar}'";
        $gruda = ", ";
    }

    if (is_string($this->observacao)) {
        $campos .= "{$gruda}observacao";
        $valores .= "{$gruda}'{$this->observacao}'";
        $gruda = ", ";
    }

    $db->Consulta("INSERT INTO {$this->_tabela} ( $campos ) VALUES( $valores )");
    return $db->InsertId("{$this->_tabela}_seq");
    }

    return FALSE;
  }

  /**
   * Edita os dados de um registro.
   * @return bool
   */
  function edita()
  {

    if (is_numeric($this->cod_motorista)) {

    $db  = new clsBanco();
    $set = '';
    
    if (is_numeric($this->cod_motorista)) {
        $set .= "{$gruda}cod_motorista = '{$this->cod_motorista}'";
        $gruda = ", ";
    }

    if (is_numeric($this->ref_idpes)) {
        $set .= "{$gruda}ref_idpes = '{$this->ref_idpes}'";
        $gruda = ", ";
    }

    if (is_string($this->cnh)) {
        $set .= "{$gruda}cnh = '{$this->cnh}'";
        $gruda = ", ";
    }

    if (is_string($this->tipo_cnh)) {
        $set .= "{$gruda}tipo_cnh = '{$this->tipo_cnh}'";
        $gruda = ", ";
    }

    if (is_string($this->dt_habilitacao) && trim($this->dt_habilitacao)!='') {

        $set .= "{$gruda}dt_habilitacao = '{$this->dt_habilitacao}'";
        $gruda = ", ";
    }

    if (is_string($this->vencimento_cnh) && trim($this->vencimento_cnh)!='') {
        $set .= "{$gruda}vencimento_cnh = '{$this->vencimento_cnh}'";
        $gruda = ", ";
    }

    if (is_numeric($this->ref_cod_empresa_transporte_escolar)) {
        $set .= "{$gruda}ref_cod_empresa_transporte_escolar = '{$this->ref_cod_empresa_transporte_escolar}'";
        $gruda = ", ";
    }

    if (is_string($this->observacao)) {
        $set .= "{$gruda}observacao = '{$this->observacao}'";
        $gruda = ", ";
    }

     if ($set) {
        $db->Consulta("UPDATE {$this->_tabela} SET $set WHERE cod_motorista = '{$this->cod_motorista}'");
        return TRUE;
      }
    }

    return FALSE;
  }

  /**
   * Retorna uma lista de registros filtrados de acordo com os par�metros.
   * @return array
   */
  function lista($cod_motorista = NULL, $nome_motorista = NULL,
    $cnh = NULL, $tipo_cnh = NULL,
    $ref_cod_empresa_transporte_escolar = NULL)
  {
    
    $sql = "SELECT {$this->_campos_lista}, (
          SELECT
            nome
          FROM
            modules.empresa_transporte_escolar emp,cadastro.pessoa p
          WHERE
            ref_cod_empresa_transporte_escolar = cod_empresa_transporte_escolar AND p.idpes = emp.ref_idpes
         ) AS nome_empresa , (SELECT nome FROM cadastro.pessoa WHERE idpes = ref_idpes) AS nome_motorista  FROM {$this->_tabela}";
    $filtros = "";

    $whereAnd = " WHERE ";
    if (is_numeric($cod_motorista)) {
      $filtros .= "{$whereAnd} cod_motorista = '{$cod_motorista}'";
      $whereAnd = " AND ";
    }

    if (is_string($nome_motorista)) {
      $filtros .= "
        {$whereAnd} TO_ASCII(LOWER((SELECT nome FROM cadastro.pessoa WHERE idpes = ref_idpes))) LIKE TO_ASCII(LOWER('%{$nome_motorista}%')) ";

      $whereAnd = ' AND ';
    }      

    if (is_string($cnh)) {
      $filtros .= "{$whereAnd} cnh = '{$cnh}'";
      $whereAnd = " AND ";
    }

    if (is_string($tipo_cnh)) {
      $filtros .= "{$whereAnd} tipo_cnh = '{$tipo_cnh}'";
      $whereAnd = " AND ";
    }    

    if (is_numeric($ref_cod_empresa_transporte_escolar)) {
      $filtros .= "{$whereAnd} ref_cod_empresa_transporte_escolar = '{$ref_cod_empresa_transporte_escolar}'";
      $whereAnd = " AND ";
    }    

    $db = new clsBanco();
    $countCampos = count(explode(',', $this->_campos_lista))+2;
    $resultado = array();

    $sql .= $filtros . $this->getOrderby() . $this->getLimite();

    $this->_total = $db->CampoUnico("SELECT COUNT(0) FROM {$this->_tabela} {$filtros}");

    $db->Consulta($sql);

    if ($countCampos > 1) {
      while ($db->ProximoRegistro()) {
        $tupla = $db->Tupla();
        $tupla["_total"] = $this->_total;
        $resultado[] = $tupla;
      }
    }
    else {
      while ($db->ProximoRegistro()) {
        $tupla = $db->Tupla();
        $resultado[] = $tupla[$this->_campos_lista];
      }
    }
    if (count($resultado)) {
      return $resultado;
    }

    return FALSE;
  }

  /**
   * Retorna um array com os dados de um registro.
   * @return array
   */
  function detalhe()
  {
    
    if (is_numeric($this->cod_motorista)) {
      $db = new clsBanco();
      $db->Consulta("SELECT {$this->_todos_campos}, (
          SELECT
            nome
          FROM
            modules.empresa_transporte_escolar emp,cadastro.pessoa p
          WHERE
            ref_cod_empresa_transporte_escolar = cod_empresa_transporte_escolar AND p.idpes = emp.ref_idpes
         ) AS nome_empresa , (SELECT nome FROM cadastro.pessoa WHERE idpes = ref_idpes) AS nome_motorista  FROM {$this->_tabela} WHERE cod_motorista = '{$this->cod_motorista}'");
      $db->ProximoRegistro();
      return $db->Tupla();
    }

    return FALSE;
  }

  /**
   * Retorna um array com os dados de um registro.
   * @return array
   */
  function existe()
  {
    if (is_numeric($this->cod_motorista)) {
      $db = new clsBanco();
      $db->Consulta("SELECT 1 FROM {$this->_tabela} WHERE cod_motorista = '{$this->cod_motorista}'");
      $db->ProximoRegistro();
      return $db->Tupla();
    }
    return FALSE;
  }

  /**
   * Exclui um registro.
   * @return bool
   */
  function excluir()
  {
    
    if (is_numeric($this->cod_motorista)) {
      $sql = "DELETE FROM {$this->_tabela} WHERE cod_motorista = '{$this->cod_motorista}'";
      $db = new clsBanco();
      $db->Consulta($sql);
      return true;
    }
    return FALSE;
  }

  /**
   * Define quais campos da tabela ser�o selecionados no m�todo Lista().
   */
  function setCamposLista($str_campos)
  {
    $this->_campos_lista = $str_campos;
  }

  /**
   * Define que o m�todo Lista() deverpa retornar todos os campos da tabela.
   */
  function resetCamposLista()
  {
    $this->_campos_lista = $this->_todos_campos;
  }

  /**
   * Define limites de retorno para o m�todo Lista().
   */
  function setLimite($intLimiteQtd, $intLimiteOffset = NULL)
  {
    $this->_limite_quantidade = $intLimiteQtd;
    $this->_limite_offset = $intLimiteOffset;
  }

  /**
   * Retorna a string com o trecho da query respons�vel pelo limite de
   * registros retornados/afetados.
   *
   * @return string
   */
  function getLimite()
  {
    if (is_numeric($this->_limite_quantidade)) {
      $retorno = " LIMIT {$this->_limite_quantidade}";
      if (is_numeric($this->_limite_offset)) {
        $retorno .= " OFFSET {$this->_limite_offset} ";
      }
      return $retorno;
    }
    return '';
  }

  /**
   * Define o campo para ser utilizado como ordena��o no m�todo Lista().
   */
  function setOrderby($strNomeCampo)
  {
    if (is_string($strNomeCampo) && $strNomeCampo ) {
      $this->_campo_order_by = $strNomeCampo;
    }
  }

  /**
   * Retorna a string com o trecho da query respons�vel pela Ordena��o dos
   * registros.
   *
   * @return string
   */
  function getOrderby()
  {
    if (is_string($this->_campo_order_by)) {
      return " ORDER BY {$this->_campo_order_by} ";
    }
    return '';
  }
}
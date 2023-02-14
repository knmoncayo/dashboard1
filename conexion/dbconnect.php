<?php
require_once('constants.php');
//$conn = mysql_connect(HOST, USER, PWD);
//mysql_select_db(DATABASE,$conn);

class MySQLConn
{
	var $link = 0;				// connection state
	var $result = 0;				// resultset
	var $rows = NULL;			// rows from query
	var $num_rows = 0;			// number of rows from query
	var $num_fills = 0;
	var $flag = false;
    function connect() {
		$this->link = mysql_connect(HOST, USER, PWD);
		mysql_select_db(DATABASE,$this->link);
		return $this->link;
	}
	
    function sqlQuery($sql) {
        $this->result = mysql_query($sql,$this->link) or die($sql."->".mysql_error());
		$this->num_rows = mysql_num_rows($this->result);
		$this->rows = mysql_fetch_array($this->result);
		$this->flag = true;
        return $this->result;
    }

    function sqlUpdate($sql) {
        $this->result = mysql_query($sql,$this->link) or die($sql."->".mysql_error());
		$this->num_rows = 0;
		$this->rows = NULL;
		$this->flag = false;
        return $this->result;
    }
	
	function getNext(){
		if ($this->flag){
			// first time!!
			$return_val = $this->rows;
			$this->flag = false;
		}
		else{
			$this->rows = mysql_fetch_array($this->result);
			$return_val = $this->rows;
		}
		return $return_val;
	}
	
	function disconnect(){
		mysql_close($this->link);
		$this->result = NULL;
		$this->rows = NULL;
		$this->num_rows = 0;
		$this->link = 0;
		$this->flag = false;
	}
}
?>

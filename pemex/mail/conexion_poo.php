<?php

/*
 * I GONNA LEAVE HERE A PICE OF CODE THAT WE CAN POSSIBLY BE PROUD OF IT,
 * BUT AS ALWAYS NOT SO SURE...
 */

public class MySqlConnection(){

	private $server		= "localhost";
	private $username	= "lectura";
	private $password	= "gacomunicacion";
	private $database	= "monitoreoGa";
	public $conection 	= null;
	public $result_data = null;

	public function __construct( $server = null , $user = null , $pass = null , $dbname = null ){
		$this->server   = $server;
		$this->username = $user;
		$this->password = $pass;
		$this->database = $dbname;
	}

	public function connect(){
		try {
			$this->connection = mysql_connect( $this->server, $this->username, $this->password );
		} catch(Exception $e ){
			die( 'Error: Hubo un problema en la conexion :( ' );
		}
	}

	public function selectDb( $db = null ){
		if( $db === null ){
			mysql_select_db( $this->database, $this->connection );
		}else{
			mysql_select_db( $db, $this->connection );
		}
	}

	public function executeQuery( $query ){
		try{
			$this->result_data = mysql_query($query);
			return $this->result_data;
		}catch( Exception $e ){
			return $e;
		}
	}

	public function numRowsInResult(){
		if( $this->result_data != null )
			return mysql_num_rows( $this->result_data );
		return null;
	}

	public function affectedRows(){
		if( $this->result_data != null )
			return mysql_affected_rows();
		return null;
	}

	public function fetchArray(){
		if( $this->result_data != null )
			return mysql_fetch_array( $this->result_data );
		else
			return null;
	}

}

<?php

class Users {
	public $tableName = 't010';
	
	function __construct(){
		
		$con = pg_connect("host=mikedutra.postgresql.dbaas.com.br dbname=mikedutra user=mikedutra password=esmorfe2");
		
		$this->connect = $con;
			
	}
	
	function checkUser($oauth_provider,$oauth_uid,$fname,$lname,$email,$gender,$locale,$link,$picture){
		$prevQuery = pg_query($this->connect,"SELECT * FROM $this->tableName WHERE oauth_provider = '".$oauth_provider."' AND oauth_uid = '".$oauth_uid."'") 
		or die(pg_last_error($this->connect));
		
		if(pg_num_rows($prevQuery) > 0){
			$update = pg_query($this->connect,"UPDATE $this->tableName SET oauth_provider = '".$oauth_provider."', oauth_uid = '"
			.$oauth_uid."', fname = '".$fname."', lname = '".$lname."', email = '".$email."', gender = '".$gender."', locale = '".$locale."', picture = '"
			.$picture."', gpluslink = '".$link."', modified = '".date("Y-m-d H:i:s")."' WHERE oauth_provider = '".$oauth_provider."' AND oauth_uid = '"
			.$oauth_uid."'") 
			or die(pg_last_error($this->connect));
		}else{
			$insert = pg_query($this->connect,"INSERT INTO $this->tableName (oauth_provider, oauth_uid, fname, lname, email, gender, 
			locale, picture, gpluslink, created, modified)
			values('".$oauth_provider."', '".$oauth_uid."', '".$fname."', '".$lname."', '".$email."', '".$gender."', '".$locale."',
			'".$picture."', '".$link."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')") 
			or die(pg_last_error($this->connect));
		}
		
		$query = pg_query($this->connect,"SELECT * FROM $this->tableName WHERE oauth_provider = '".
		$oauth_provider."' AND oauth_uid = '".$oauth_uid."'") or die(pg_last_error($this->connect));
		$result = pg_fetch_array($query);
		return $result;
	}
	
	function recupera_user($oauth_provider,$oauth_uid){
		
		$query = pg_query($this->connect,"SELECT * FROM $this->tableName WHERE oauth_provider = '".
		$oauth_provider."' AND oauth_uid = '".$oauth_uid."'") or die(pg_last_error($this->connect));
		$result = pg_fetch_array($query);
		
		if(pg_num_rows($query) == 0){
			return null;
		}else{
			return $result;
		}
		
	}
}

?>
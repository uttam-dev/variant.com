<?php

class Database
{

	private $db_host = "localhost";
	private $db_user = "root";
	private $db_pass = "";
	private $db_name = "variant_db";

	private $result = array();
	private $mysqli = "";
	private $myQuery = "";

	private $conn = false;

	public function __construct()
	{

		if (!$this->conn) {

			$this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

			// Check connection
			if ($this->mysqli->connect_errno > 0) {
				array_push($this->result, $this->mysqli->connect_error);
				return false; 
			}

		} else {
			return true;
		}
	}


	// Function to insert into the database
	public function insert($table, $params = array())
	{
		
		if ($this->tableExists($table)) {

			$table_columns = implode(', ', array_keys($params));
			$table_value = implode("', '", $params);

			$sql = "INSERT INTO $table ($table_columns) VALUES ('$table_value')";

			$this->myQuery = $sql; 
			
			if ($this->mysqli->query($sql)) {
			
				array_push($this->result, 1);
			
			} else {
				array_push($this->result, $this->mysqli->error);
				return false; 
			}
		} else {
			return false; 
		}
	}

	// Function to update row in database
	public function update($table, $params = array(), $where = null)
	{
	
		if ($this->tableExists($table)) {
			
			$args = array();
			foreach ($params as $key => $value) {
				$args[] = "$key='$value'";
			}
		
			$sql = "UPDATE $table SET " . implode(',', $args);
			if ($where != null) {
				$sql .= " WHERE $where";
			}
			$this->myQuery = $sql;
		
			if ($query = $this->mysqli->query($sql)) {
				array_push($this->result, $this->mysqli->affected_rows);
				return true; 
			} else {
				array_push($this->result, $this->mysqli->error);
				return false; 
			}
		} else {
			return false;
		}
	}

	//Function to delete table or row(s) from database
	public function delete($table, $where = null)
	{
	
		if ($this->tableExists($table)) {

			$sql = "DELETE FROM $table"; 
			if ($where != null) {
				$sql .= " WHERE $where";
			}
			
			if ($this->mysqli->query($sql)) {
				array_push($this->result, $this->mysqli->affected_rows);
				
				return true; 
			} else {
				array_push($this->result, $this->mysqli->error);
				return false; 
			}
		} else {
			return false; 
		}
	}

	// Function to SELECT from the database
	public function select($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null)
	{
		
		if ($this->tableExists($table)) {
			
			$sql = "SELECT $rows FROM  $table";
			if ($join != null) {
				$sql .= ' JOIN ' . $join;
			}
			if ($where != null) {
				$sql .= ' WHERE ' . $where;
			}
			if ($order != null) {
				$sql .= ' ORDER BY ' . $order;
			}
			if ($limit != null) {
				if (isset($_GET["page"])) {
					$page = $_GET["page"];
				} else {
					$page = 1;
				}
				$start = ($page - 1) * $limit;

				$sql .= ' LIMIT ' . $start . ',' . $limit;
			}

			$this->myQuery = $sql;
			
			$query = $this->mysqli->query($sql);

			if ($query) {
				$this->result = $query->fetch_all(MYSQLI_ASSOC);
				return true; 
			} else {
				array_push($this->result, $this->mysqli->error);
				return false; 
			}
		} else {
			return false; 
		}
	}

	
	public function sql($sql)
	{
		$this->myQuery = $sql; 
		$query = $this->mysqli->query($sql);

		if ($query) {
			$sql_array = explode(' ', $sql);
			switch ($sql_array[0]) {
				case "INSERT":
					array_push($this->result, $this->mysqli->insert_id);
					break;
				case "UPDATE":
					array_push($this->result, $this->mysqli->affected_rows);
					break;
				case "DELETE":
					array_push($this->result, $this->mysqli->affected_rows);
					break;
				case "SELECT":
					array_push($this->result, $query->fetch_all(MYSQLI_ASSOC));
					break;
			}
		
			return true;
		} else {
			array_push($this->result, $this->mysqli->error);
			return false; 
		}
	}

	// Private function to check if table exists for use with queries
	private function tableExists($table)
	{
		$tablesInDb = $this->mysqli->query("SHOW TABLES FROM  $this->db_name LIKE '$table'");
		if ($tablesInDb) {
			if ($tablesInDb->num_rows == 1) {
				return true; 
			} else {
				array_push($this->result, $table . " does not exist in this database");
				return false;
			}
		}
	}

	// Public function to return the data to the user
	public function getResult()
	{
		$val = $this->result;
		$this->result = array();
		return $val;
	}

	// close connection
	public function __destruct()
	{
		if ($this->conn) {
			if ($this->mysqli->close()) {
				$this->conn = false;
				return true;
			} else {
				return false;
			}
		}
	}
}


?>
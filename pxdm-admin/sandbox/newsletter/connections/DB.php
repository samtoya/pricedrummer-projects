<?php
	
	namespace Connections;
	
	class DB {
		
		private $host = 'localhost';
		private $username = 'root';
		private $password = '';
		private $database = 'locaalhost';
		
		/**
		 * DB constructor.
		 */
		public function __construct() {
			$this->connect();
		}
		
		private function connect() {
//			try {
//				$link = new \PDO("host:{$this->host};dbname={$this->database}", $this->username, $this->password);
//			} catch(\PDOException $e) {
//				echo "Failed to connect to database: " . $e->getMessage();
//			}
			$link = mysqli_connect( $this->host, $this->username, $this->password );
			if ( $link ) {
				mysqli_select_db( $link, $this->database );
			}
		}
	}
	
	$conn = new DB();
<?php
	class t_database {
		var $mysqli;
		function __construct($hostname, $username, $password, $dbname) {
			$this->mysqli = new mysqli($hostname, $username, $password, $dbname);
		}
		function add_user($username, $password) {
			$query = "insert into users (name, password) values ('".$this->mysqli->real_escape_string($username)."', '".$this->mysqli->real_escape_string($password)."')";
			$this->mysqli->query($query);
		}
		function check_user($username, $password) {
			$query = "select id from users where username = '".$this->mysqli->real_escape_string($username)."' and password = '".$this->mysqli->real_escape_string($password)."'";
			$p = $this->mysqli->query($query);
			return $mysqli->num_rows;
		}
		function get_relevant_articles($uid) {
			$query = "select tags.tag from tags, t_connections, users where users.uid_ = t_connection.uid_ and tags.id = t_connections.tid and t_connections.orig = 0 and users.uid_ = ".$this->mysqli->real_escape_string($uid);
			$l = [];
			$p = [];
			$rio = $this->mysqli->query($query);
			for ($i = 0; $i < $rio->num_rows; $i++) {
				$rio->data_seek($i);
				$row_no = $rio->fetch_assoc();
				$p[] = $row_no;
			}
			for ($i = 0; $i < count($p); $i++) {
				$query = "select articles.name articles.url articles.simplified articles.date_ from articles, users, tags, t_connections where tags.tag = '".$this->mysqli->real_escape_string($p[$i])."' and tags.id = t_connections.tid and t_connections.orig = 1 and articles.tid = t_connections.uid_ order by articles.date_p desc limit 15;"
				$rio = $this->mysqli->query($query);
				for ($i = 0; $i < $rio->num_rows; $i++) {
					$rio->data_seek($i);
					$row_no = $rio->fetch_assoc();
					$l[] = $row_no;
				}
			
			}
			return $l;
		}
		function add_tag($uid, $tag) {
			$query = "insert ignore into tags (tag) values ('".$this->mysqli->real_escape_string($tag)."')";
			$this->mysqli->query($query);
			$p = $this->mysqli->insert_id;
			$que = "insert into into t_connections (uid_, tid, orig) values ('".$this->mysqli->real_escape_string($uid)."', '".$p."', '0')";
			$this->mysqli->query($que);
		}
	}
?>

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

		// TODO
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
		function install_application($uid, $aid) {
			$query = "select version, pub from apps where id = '".$this->mysqli->real_escape_string($aid)."'";
			$p = $this->mysqli->query($query);
			
			$p->data_seek(0);
			$row = $p->fetch_assoc();
			$ro = $row["version"];

			$query = "insert into app_vers (uid_, ver, aid) values ('".$this->mysqli->real_escape_string($uid)."', '".$this->mysqli->real_escape_string($ro)."', '".$this->mysqli->real_escape_string($aid)."')";
			$this->mysqli->query($query);
			return $row["pub"];
		}
		function update_application($uid, $aid) {
			$query = "update app_vers, apps, users set app_vers.ver = apps.version where apps.id = '".."' and app_vers.aid = apps.id and app_vers.uid_ = users.uid_ and users.uid_ = '".."'";
			$this->mysqli->query($query);
		}
		function uninstall_application($uid, $aid) {
			$query = "delete from app_vers where uid_ = '".$this->mysqli->real_escape_string($uid)."' and aid = '".$this->mysqli->real_escape_string($aid)."'";
			$this->mysqli->query($query);
		}
		function check_installed($aid, $uid) {
			$query = "select app_vers.ver as inst, apps.version as curr from apps, app_vers where apps.id = app_vers.aid and app_vers.aid = '".$aid."' and app_vers.uid_ = '".$uid."'";
			$q = $this->mysqli->query($query);
			if ($q->num_rows == 0)
				return -1;
			$q->data_seek(0);
			$l = $q->fetch_assoc();
			if ($l["inst"] == $l["curr"]) {
				return 1;
			} else {
				return 0;
			}
		}
		function get_app_id($name) {
			$quer = "select id from apps where name = '".$this->mysqli->real_escape_string($name)."'";
			$p = $this->mysqli->query($quer);
			$p->data_seek(0);
			$ro = $p->fetch_assoc();
			return $ro["id"];
		}
		function get_app_info($aid) {
			$quer = "select name, url, desc from apps where id = '".$aid."'";
			$l = $this->mysqli->query($quer);
			$ro = [];
			if ($l->num_rows == 0) {
				return 0;
			}
			$l->data_seek(0);
			return $l->fetch_assoc();
		}
		function get_app_list($uid) {
			$quer = "select apps.name, apps.url, apps.desc from apps, app_vers where apps.id = app_vers.aid and app_vers.uid_ = '".$uid."'";
			$l = $this->mysqli_->query($quer);
			$ro = []
			for ($i = 0; $i < $l->num_rows; $i++) {
				$l->data_seek($i);
				$o = $l->fetch_assoc();
				$ro[] = $o;
			}
			return $ro;
		}	
	}
?>

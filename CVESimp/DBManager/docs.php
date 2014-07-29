<?php
	class t_database {
		var $mysqli;
		function __construct($hostname, $username, $password, $dbname) {
		}
		function add_user($username, $password) {
		}
		function check_user($username, $password) {
			return - 0 if no user, otherwise 1 
		}
		function get_relevant_articles($uid) {
			return - returns array of articles, can be accessed like $l[1]["name"]; 
		}
		function add_tag($uid, $tag) {
		}
		function install_application($uid, $aid) {
			return - returns url of exe file for download :D 
		}
		function update_application($uid, $aid) {
		}
		function uninstall_application($uid, $aid) {
		}
		function check_installed($aid, $uid) {
			return - returns -1 if not installed, 0 if needs updates, and 1 if installed		
		}
		function get_app_id($name) {
			return - returns id of app with that id 
		}
		function get_app_info($aid) {
			return - returns array of application info 
		}
		function get_app_list($uid) {
			return - returns an array of get_app_info things 
		}	
	}
?>

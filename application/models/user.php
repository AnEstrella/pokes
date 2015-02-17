<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	//all users except current user
	function all_users($user_id)
	{
		return $this->db->query("SELECT users.id, users.name, users.alias, users.email, pokes.poker_id, pokes.user_id, COUNT(user_id) FROM users LEFT OUTER JOIN pokes ON users.id = user_id WHERE users.id NOT IN (SELECT users.id FROM users WHERE users.id= {$user_id}) GROUP BY users.id")->result_array();
	}

	function add_user($user_data)
	{
		$query = "INSERT INTO users (name, alias, email, password, dob) VALUES (?,?,?,?,?)";
		$values = array($user_data['name'], $user_data['alias'], $user_data['email'], $user_data['password'], $user_data['dob']);
		return $this->db->query($query, $values);
	}

	function get_user_by_email($email)
	{
		return $this->db->query("SELECT * FROM users WHERE email = ?", array($email))->row_array();
	}

	//function user
}
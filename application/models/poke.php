<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poke extends CI_Model {

	function all_pokes()
	{
		return $this->db->query("SELECT * FROM pokes")->result_array();
	}
	function users_pokes($user_id)
	{
		return $this->db->query("SELECT name AS 'poker', pokes.poker_id,COUNT(*) FROM users LEFT OUTER JOIN pokes ON users.id = poker_id WHERE user_id = {$user_id} GROUP BY pokes.poker_id;")->result_array();
	}
	function add_poke($pokee_id, $poker_id)
	{
		$query = "INSERT INTO pokes_db.pokes (user_id, poker_id) VALUES ({$poker_id}, {$pokee_id})";
		return $this->db->query($query);
	}
	function poke_count($user_id)
	{
		return $this->db->query("SELECT COUNT(*) FROM pokes_db.pokes WHERE user_id = {$user_id}")->row_array();
	}
	// function delete_poke()
	// {

	// }
	// function edit_poke()
	// {

	// }

}
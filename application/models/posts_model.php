<?php

/**
 * Posts model class
 */
class Posts_model extends CI_Model {

	/**
	 * Load the database library
	 */
	public function __construct()
	{
		$this->load->database();
	}
	
	/**
	 * Get the post data
	 *
	 * Check if a slug is defined and get the proper records.
	 *
	 * @param bool|string $slug the page slug
	 */
	public function get_posts($slug = FALSE)
	{
		if ($slug === FALSE)
		{
			$query = $this->db->get('posts');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('posts', array('slug' => $slug));
		return $query->row_array();
	}
	
	/**
	 * Submit new post
	 *
	 * Formats the data and inserts it into the database.
	 */
	public function set_posts($upload_results)
	{
		// Load the URL helper.
		$this->load->helper('url');
		
		// Strip down the slug.
		$slug = url_title($this->input->post('title'), 'dash', TRUE);
		
		// Build the address for the post image.
		$upload_full_path = site_url() . 'uploads/' . $upload_results['upload_data']['file_name'];
		
		// Create an array for database insertion.
		$data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'text' => $this->input->post('text'),
			'image' => $upload_full_path
		);
		
		// Insert the array into the database.
		return $this->db->insert('posts', $data);
	}
}

?>
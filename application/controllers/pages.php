<?php

/**
 * Pages controller class
 */
class Pages extends CI_Controller {

	/**
	 * Load the language file and url helpers.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->lang->load('general');
	}

	/**
	 * Loads the views
	 *
	 * Checks if a view for the page type requested exists, then loads the default 404 or the approporiate template files.
	 *
	 * @param string $page the page type requested
	 */
	public function view($page = 'home')
	{
		
		// Check if the template exists.
		if ( ! file_exists('application/views/pages/'.$page.'.php'))
		{
			show_404();
		}
		
		// Define a title and capitalize the first letter.
		$data['title'] = ucfirst($page);
		
		// Load the view templates.
		$this->load->view('templates/header', $data);
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer', $data);

		// Set the cache for five minutes.
		$this->output->cache(5);
	}
}

?>
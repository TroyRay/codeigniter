<?php

/**
 * Posts controller class
 */
class Posts extends CI_Controller {

	/**
	 * Load the posts model, language file, and url helper
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('posts_model');
		$this->load->helper('url');
		$this->lang->load('general');
	}

	/**
	 * Load all posts when viewing the index page
	 */
	public function index()
	{
		// Get all articles.
		$data['posts'] = $this->posts_model->get_posts();
		// Flip the order so newest post is on top.
		$data['posts'] = array_reverse($data['posts']);
		
		// Define a title.
		$data['title'] = $this->lang->line('gen_posts_archive');
		
		// Load the view templates.
		$this->load->view('templates/header', $data);
		$this->load->view('posts/index', $data);
		$this->load->view('templates/footer');
	}

	/**
	 * Load the slug approporiate posts
	 *
	 * @param bool|string $slug the page slug
	 */
	public function view($slug)
	{
		$data['post_item'] = $this->posts_model->get_posts($slug);

		// Check if the post item exists.
		if (empty($data['post_item']))
		{
			show_404();
		}

		// Set the defined title.
		$data['title'] = $data['post_item']['title'];

		// Load the view templates.
		$this->load->view('templates/header', $data);
		$this->load->view('posts/view', $data);
		$this->load->view('templates/footer');
	}
	
	/**
	 * Submit a post
	 *
	 * Validate the form input, reload the form if it fails, or else submit the post and load the success view.
	 */
	public function submit()
	{
		// Load form helper and form validation library then set error message wrapper.
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		// Set upload configs and load the upload library.
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';
		$this->load->library('upload', $config);
		
		// Define a title.
		$data['title'] = $this->lang->line('gen_post_submit');
		
		// Set the validation rules.
		$this->form_validation->set_rules('title', 'lang:Title', 'required|xss_clean');
		$this->form_validation->set_rules('text', 'lang:Text', 'required|xss_clean');
		
		// Check validation, reload form with errors if it fails, else submit post and load success view.
		if ($this->form_validation->run() === FALSE)
		{
			if ( ! $this->upload->do_upload())
			{
				$data['upload_error'] = array('error' => $this->upload->display_errors());
			}
			$this->load->view('templates/header', $data);	
			$this->load->view('posts/submit', $data);
			$this->load->view('templates/footer');
			
		}
		else
		{
			if ( ! $this->upload->do_upload())
			{
				$data['upload_error'] = array('error' => $this->upload->display_errors());
				$this->load->view('templates/header', $data);
				$this->load->view('posts/submit', $data);
				$this->load->view('templates/footer');
			}
			// Submitted post is good to go.
			else
			{
				$upload_results = array('upload_data' => $this->upload->data());
				$this->posts_model->set_posts($upload_results);
				$this->load->view('templates/header', $data);
				$this->load->view('posts/success');
				$this->load->view('templates/footer');
			}
		}
	}
}

?>
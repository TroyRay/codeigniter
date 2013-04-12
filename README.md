codeigniter
=========

Basic demonstration of CodeIgnitor



migration
=========

You will need to follow these steps to migrate this application to your server (mod_rewrite must be enabled).

	Install CodeIgniter.
	
	Add the repository files overwriting any existing files.

	Edit the $config['base_url'] in application/config/config.php
	
	Create a database and import the mysql.sql file located in the root.
	
	Edit the database connection details in application/config/database.php.



changelog
=========

	12 Apr 2013 - Initial commit of files.



notes
=========

Notes that cover general CodeIgniter usage along with a few common library and helper features.

	URL structure: [site_url (base_url + index_page)] / [controller class] / [class method] / [addition arguments (passed to the method)]

	Class names must start with an uppercase letter and the rest of the name lowercase.

	The index() method is called if no class method is in the URL.

	The _remap() method, if defined, will always be called allowing the routing to be modified. When _remap() is called, the class method if in the URL, is passed as the first argument. Any additional arguments in the URL will be passed as an optional array for the second argument.

	The _output() method will receive the finalized output data, allowing you to output the data manually.
		
		Please note that your _output() function will receive the data in its finalized state. Benchmark and memory usage data will be rendered, cache files written (if you have caching enabled), and headers will be sent (if you use that feature) before it is handed off to the _output() function. To have your controller's output cached properly, it's _output() method can use:

		if ($this->output->cache_expiration > 0)
		{
			$this->output->_write_cache($output);
		}

		If you are using this feature the page execution timer and memory usage stats might not be perfectly accurate since they will not take into acccount any further processing you do. For an alternate way to control output before any of the final processing is done, please see the available methods in the Output Class.
		
	To make a function private, so it cannot be accessed by URL, declare it private and start the function name with an _

	Controllers can be added to a subdirectory, but then the URL to access the controller must contain the subdirectory in it.

	Controller contructors must call the parent constructor 'parent::__construct();'

	Use '$this->load->view('name');' within the controller to load a view. You can pass an array or object to the view with an optional second parameter. Multiple calls to load a view will be appended together once the call happens. There is a third optional parameter lets you change the behavior of the function so that it returns data as a string rather than sending it to your browser. This can be useful if you want to process the data in some way. If you set the parameter to true (boolean) it will return data. The default behavior is false, which sends it to your browser.

	Use '$this->load->model('Model_name');' within the controller to load a model. If you would like your model assigned to a different object name you can specify it in an optional second parameter.

	Models can be automatically loaded globally by opening the application/config/autoload.php file and adding the model to the autoload array. The model can connect to the database by calling '$this->load->database();'. You can tell the model loading function to auto-connect to the database by passing TRUE (boolean) as the optional third parameter. You can also manually pass database connectivity settings via an array in the optional third parameter.

	Use '$this->load->helper('name');' to load a helper file anywhere in the controller. You can pass an array instead to load multiple helpers. You can automatically load a helper globally by opening the application/config/autoload.php file and adding the helper to the autoload array. To extend Helpers, create a file in the application/helpers/ folder with an identical name to the existing Helper, but prefixed with 'MY_', to use a custom prefix, change '$config['subclass_prefix']' in application/config/config.php (do not use CI_).

	Use '$this->load->library('class name');' in your controller to load a library. Multiple libraries can be loaded at the same time by passing an array of libraries to the load function.

	You can create, extend (the same was as Helpers using the MY_ (default) prefix), and replace libraries using the application/libraries directory, but the Database classes can not be extended or replaced with your own classes. File and class names must be capitalized and match each other. When loading a library you can pass parameters as a optional second parameter or from a config file, simply create a config file named identically to the class file name and store it in your application/config/ folder.
		
		To access CodeIgniter's native resources within your library use the get_instance() function. This function returns the CodeIgniter super object. If you assign it to a variable, make sure to pass by reference, as to not create an entire copy ( '$CI =& get_instance();' ).
		
	Use '$this->load->driver('class name');' to load drivers, which are a special type of Library that has a parent class and any number of potential child classes. Drivers are found in the system/libraries folder, in their own folder which is identically named to the parent library class. The child classes, the drivers themselves, can then be called directly through the parent class, without initializing them using '$this->some_parent->child_one->some_method();'. You can add custom Drivers in /application/libraries/, and they must have the first letter capatalized.

	You can replace core classes by dropping a file with the exact core file name in application/core/, the class must be prefixed with CI_. You can extend core classes using the MY_ prefix just as with libraries and helpers.
	
	Hooks can be globally enabled using '$config['enable_hooks']' in the application/config/config.php file. Hooks can be defined in the application/config/hooks.php file.
		$hook['pre_controller'] = array('class'    => 'MyClass', 'function' => 'Myfunction', 'filename' => 'Myclass.php', 'filepath' => 'hooks', 'params'   => array('beer', 'wine', 'snacks') );
		Available hook points: pre_system, pre_controller, post_controller_constructor, post_controller, display_override (you will need to reference the CI superobject with '$this->CI =& get_instance()' and then the finalized data will be available by calling '$this->CI->output->get_output()'), cache_override, and post_system.
		
	To autoload resources, open the application/config/autoload.php file and add the item you want loaded to the autoload array.
	
	Globally available functions: is_php('version_number'), is_really_writable('path/to/file'), config_item('item_key'), show_error('message'), show_404('page'), log_message('level', 'message'), set_status_header(code, 'text'), remove_invisible_characters($str), and html_escape($mixed).
	
	Routing rules are defined in your application/config/routes.php file as wildcards ( (:num) or (:any) ) or Regular Expressions, the array key contains the URI to be matched, while the array value contains the destination it should be re-routed to. Do not use leading/trailing slashes. Routes will run in the order they are defined, higher routes will always take precedence over lower ones. '$route['default_controller']' and '$route['404_override']' are reserved routes and must come before any wildcard or regular expression routes.
	
	'show_error('message' [, int $status_code= 500 ] )' will throw and error. 'show_404('page' [, 'log_error'])' displays the 404 page. 'log_message('level', 'message')' lets you write messages to your log files, you must supply one of three "levels" in the first parameter (debug, error, info). You can set the threshold for logging in the application/config/config.php file.
	
	Use '$this->output->cache(minutes);' in your controller to cache the output.
	
	Use '$this->output->enable_profiler(TRUE);' in your controller to display profilers information at the bottom of the page. You can set benchmark points using '$this->benchmark->mark('point_name');' and 'echo $this->benchmark->elapsed_time('start_point_name', 'end_point_name');' anywhere within your controllers, views, or your models. If you want your benchmark data to be available in the profiler all of your marked points must be set up in pairs, and each mark point name must end with _start and _end. Each pair of points must otherwise be named identically. Using 'echo $this->benchmark->elapsed_time();' (or {elapsed_time} in a view) with no argument will show the total elapsed time from the moment CodeIgniter starts to the moment the final output is sent to the browser. Using 'echo $this->benchmark->memory_usage();' in a view (or {memory_usage}) will display the amount of memory consumed by the entire system.
	
	You can run CodeIgniter through the command line using '$ php index.php controller method arguments'.
	
	You can rename the application folder using the '$application_folder' variable in the main index.php file. You can move the application folder by using the full server path. You can run mutiple applications with one installation of CodeIgniter by putting all application contents into a subdirectory and setting it in the '$application_folder' variable. Each of your applications will need its own index.php file which calls the desired application, the index.php file can be named anything you want.
	
	There is an environment constant at the top of the index.php file, setting it to a value of 'development' will cause all PHP errors to be rendered to the browser when they occur, and setting the constant to 'production' will disable all error output.
	
	You can use PHP short tags in your template files and CodeIgniter will optionally rewrite short tags on-the-fly, allowing you to use that syntax even if your server doesn't support it.
	
	URL's may only contain alpha-numeric text, ~, ., :, _, and -.
	
	The magic_quotes_runtime directive is turned off during system initialization so that you don't have to remove slashes when retrieving data from your database.
	
	The PHP closing tag is optional and can be replaced with a comment block instead to avoid whitespace errors.
	
	Any tables that your add-on might use must use the 'exp_' prefix, followed by a prefix uniquely identifying you as the developer or company, and then a short descriptive table name.
	
	Use '$this->load->database();' to manually initialize the database class, or set it to automatically load in the application/config/autoload.php file.
		Available Parameters
			The database connection values, passed either as an array or a DSN string, or a particular database group from your config file.
			Whether to return the connection ID (see Connecting to Multiple Databases below). TRUE/FALSE (boolean).
			Whether to enable the Active Record class. Set to TRUE by default. TRUE/FALSE (boolean).
	
	Pinging the server by using the reconnect() method can gracefully keep the connection alive or re-establish it.
	
	You can explicitly close the connection using the close() method, or let CodeIgniter close it for you.
	
	Use '$query = $this->db->query('the_query');' to run a query. The query() function returns a database result object when read type queries are run. When write type queries are run it simply returns TRUE or FALSE depending on success or failure.
		The num_rows() function will return the number of rows the query returned.
		The num_fields() function will return the number of fields(columns) the query returned.
		The result() function returns an array of objects and the result_array() function returns an array of standard array indexes.
		The row() function returns an object and the row_array() function returns an array. If the query finds more than one row, only the first will be returned.
			In addition, you can walk forward/backwards/first/last through your results using these variations.
				$row = $query->first_row()
				$row = $query->last_row()
				$row = $query->next_row()
				$row = $query->previous_row()
					By default they return an object unless you put the string 'array' in the parameter.
	
	Database connection details can be set in the application/config/database.php file. You can set database connection values for specific environments by placing database.php it the respective environment config folder.
	
	You can edit the '$active_group' variable in the application/config/config.php file to switch between mutiple database connection setting groups.
	
	You can toggle use of the Active Record Class using the '$active_record' variable in the application/config/config.php file. Disable it if you don't use it to save resources. 
	
	Use dbprefix('table_name') to add the database prefix to a table name. Use set_dbprefix('new_prefix') to change the prefix.
	
	Use protect_identifiers('table_name', [add prefix, boolean]) to protect table and field names.
	
	Use the escape() function to determine the data type, escape only string data, and automatically add single quotes around the data. Using escape_str() will escape the data no matter what type it is. The escape_like_str() method should be used when strings are to be used in LIKE conditions so that LIKE wildcards ('%', '_') in the string are also properly escaped.
	
	Query bindings enable you to simplify your query syntax by letting the system put the queries together for you.
		$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";
		$this->db->query($sql, array(3, 'live', 'Rick'));
			The question marks in the query are automatically replaced with the values in the array in the second parameter of the query function.
			
	The free_result() function frees the memory associated with the result and deletes the result resource ID.
	
	The insert_string() function simplifies the process of writing database inserts. It returns a correctly formatted SQL insert string. Values are automatically escaped, producing safer queries.
	
	The update_string() function simplifies the process of writing database updates. It returns a correctly formatted SQL update string. Values are automatically escaped, producing safer queries.
	
	The count_all('table_name') function returns the number of rows in a particular table. Submit the table name in the first parameter.
	
	The list_tables() function returns an array containing the names of all the tables in the database you are currently connected to.
	
	The table_exists('table_name')function checks whether a particular table exists and returns a boolean TRUE/FALSE.
	
	The list_fields('table_name') function returns an array containing the field names.
	
	The field_exists('table_name')function checks whether a particular table exists and returns a boolean TRUE/FALSE.
	
	The field_data('table_name') function returns an array of objects containing field information.
	
	The call_function('function_name') function enables you to call PHP database functions that are not natively included in CodeIgniter, in a platform independent manner.
	
	To cache database queries, create a database cache directory and set the path to your cache folder and enable caching in the application/config/database.php file.
	
	Use the cache_on() and cache_off() functions to toggle caching on the fly.
	
	Use the cache_delete('uri_1', 'uri_2', 'etc') function to delete the cache files associated with a particular page. If no parameters are used the current URI will be used when determining what should be cleared.
	
	Use the cache_delete_all() function to delete all cache files.
	
	Use '$this->load->dbforge()' to load the Forge class, your database driver must already be running.
	
	Use '$this->dbforge->create_database('db_name')' to create a database. Returns TRUE/FALSE based on success or failure.
	
	Use '$this->dbforge->drop_database('db_name')' to drop a database. Returns TRUE/FALSE based on success or failure.
	
	Use '$this->dbforge->add_field($fields)' to add fields. Pass either an associative array or query string. The following key => value pairs can be used; type => 'type', constraint => int, unsigned => TRUE, default => 'value', null => TRUE, auto_increment => TRUE. A field with type id will automatically be assinged as an INT(9) auto_incrementing Primary Key. Must be followed by a call to create_table().
	
	The '$this->dbforge->add_key('field')' to add a key. An optional second parameter set to TRUE will make it a primary key. Multiple column non-primary keys must be sent as an array.
	
	Use '$this->dbforge->create_table('table_name')' to create a table with the fields and keys previously defined. An optional second parameter set to TRUE adds an "IF NOT EXISTS" clause into the definition.
	
	Use '$this->dbforge->drop_table('table_name')' to drop a table.
	
	Use '$this->dbforge->rename_table('old_name', 'new_name')' to rename a table.
	
	Use '$this->dbforge->add_column('table_name', $fields)' to modify an existing table using the same parameters as add_field().
	
	Use '$this->dbforge->drop_column('table_name', 'column_to_drop')' to remove a column from a table. 
	
	Use '$this->dbforge->modify_column('table_name', $fields)' is just like add_column(), but instead it modifies an existing column.
	
	Use '$this->config->item('item name')' to fetch a config item. The function returns FALSE (boolean) if the item you are trying to fetch does not exist.
	
	You can dynamically set a config item or change an existing one using '$this->config->set_item('item_name', 'item_value')'.
	
	Using '$this->config->site_url()' retrieves the URL to your site, along with the "index" value you've specified in the config file.
	
	Using '$this->config->base_url('path')' retrieves the URL to your site, plus an optional path.
	
	Using '$this->config->system_url()' retrieves the URL to your system folder.
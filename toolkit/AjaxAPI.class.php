<?php

/**
 * Class that automatically calls a callback function from AJAX calls.
 * @package  WP Toolkit
 * @author Curtis Schwoebel <curtis@afonsowilsson.se>
 */
class AjaxAPI extends ModuleBase {

	var $name = 'Ajax API';
	var $version = '1.3';
	var $author = 'Curtis Schwoebel';
	var $description = 'Enables an Ajax API';

	static $settings = array(
		'allowJSONP' => false,
	);

	function __construct($settings = array()){
		add_action('wp_ajax_AjaxAPI', array(&$this, 'Run'));
		add_action('wp_ajax_nopriv_AjaxAPI', array(&$this, 'Run'));
		add_action('wp_head', array(&$this, 'PrintAjaxUrl'));
		add_action('admin_head', array(&$this, 'PrintAjaxUrl')); 

		if(!empty($settings) && is_array($settings)){
			array_merge($this->settings, $settings);
		}

		parent::__construct();
	}

    /**
	 * Parses Ajax-calls made with action=AjaxAPI and calls a callback function
	 * Requires GET/POST-argument "command" or "command_class" and "command".
	 */
	function Run(){
		if(empty($_REQUEST['command'])){
			AjaxAPI::ReturnError(__('Missing argument "command"'));
		}
		else{
			if(function_exists($_REQUEST['command'])){
				call_user_func_array($_REQUEST['command'], array());
			}
			elseif(!empty($_REQUEST['command_class'])){
				if(class_exists($_REQUEST['command_class']) && method_exists($_REQUEST['command_class'], $_REQUEST['command'])){
					call_user_func_array(array($_REQUEST['command_class'], $_REQUEST['command']), array());
				}
				else{
					AjaxAPI::ReturnError(__('The command does not exist as a method', THEME_TEXTDOMAIN));
				}
			}
			else{
				AjaxAPI::ReturnError(__('The command does not exist', THEME_TEXTDOMAIN));
			}
		}
	}


	/**
	 * Public function to return JSON formatted data. Returns status (true/false), data and maybe message.
	 * @param boolean $status
	 * @param array/string $data
	 * @param string $message
	 */
	public  static function ReturnJSON($status = true, $data = array(), $message = ''){
		header('content-type: application/json; charset=utf-8');

		if(self::$settings['allowJSONP'] === true && !empty($_REQUEST['callback'])){
			echo($_REQUEST['callback'] . '(');
		}

		if(empty($message)){
			echo(json_encode(array('status'=>$status, 'data'=>$data)));
		}
		else{
			echo(json_encode(array('status'=>$status, 'data'=>$data, 'message' => $message)));
		}

		if(self::$settings['allowJSONP'] === true && !empty($_REQUEST['callback'])){
			echo(')');	
		}

		die();
	}

	/**
	 * Returns a JSON formatted error message, It's a shortcut to AjaxAPI::ReturnJSON()
	 * @param string $message Error message.
	 */
	public static function ReturnError($message){
		AjaxAPI::ReturnJSON(false, false, $message);
	}

	/**
	 * Helpful function that prints the Ajax URL in <HEAD> for later use.
	 */
	public function PrintAjaxUrl(){
		echo("\n\n<script type=\"text/javascript\">\n\n\nwindow.wptoolkit = {ajaxUrl: '" . get_site_url() . "/wp-admin/admin-ajax.php'};\n\n</script>");
	} 

}

?>
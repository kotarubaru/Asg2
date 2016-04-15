<?php

/**
 * core/Base_Controller.php
 *
 * Default application controller
 */
class Base_Controller extends CI_Controller
{
    /* Parameters for view components */
    protected $data;
    
    /**
     * An array of pages to list in the dropdown nav menu, associated with their links. 
     * Wrapped in an outer array to make it easy to pass to the parser.
     */
    protected $menu = array(
        'menu_data' => array(
            array('name' => 'Portfolio', 'link' => '/portfolio'),
            array('name' => 'Bot Assembly', 'link' => '/assembly'),
        )
    );

    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */
    function __construct()
    {
        parent::__construct();
        session_start();
        $this->data = array();
        $this->data['pagetitle'] = 'Super Bot Card Collector';
    }

    /**
     * Render this page
     */
    function render()
    {
        // Fill in our navbar view templates
        $this->data['menu']     = $this->build_menu();
        $this->data['login']    = $this->build_login();
        
        // Simple fill in for the main page content, if not already handled by the derived controller
        if (isset($this->data['view']))
            $this->data['content'] = $this->parser->parse($this->data['view'], $this->data, true);
        
        // Fill in the main view template
        $this->parser->parse('_template', $this->data);
    }
    
    /**
     * Render the Menu dropdown in the nav section
     */
    private function build_menu()
    {
        return $this->parser->parse('_menu', $this->menu, true);
    }

    /**
     * Render the Login nav section
     * If the user is not logged in, add a login dropdown;
     * If the user is logged in, show their name and a logout link
     */
    private function build_login()
    {
        if (!isset($_SESSION['login_name']))
            return $this->parser->parse('_login', $this->data, true);
            
        $this->data['username'] = $_SESSION['login_name'];
        return $this->parser->parse('_logout', $this->data, true);
    }
    
    /**
     * Log the provided username in.
     */
    function login($username)
    {
        $_SESSION['login_name'] = $username;
        // Send the user back to the page they came from
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    /**
     * Log the currently logged-in user out, if there is one
     */
    function logout()
    {
        if (isset($_SESSION['login_name']))
            unset($_SESSION['login_name']);
        // Send the user back to the page they came from
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
    /**
     * Helper method for retrieving login status
     */
    function is_logged_in()
    {
        return isset($_SESSION['login_name']);
    }
    
    /**
     * Helper method to retrieve the name of the currently logged-in user
     */
    function get_username()
    {
        if ($this->is_logged_in())
            return $_SESSION['login_name'];
        return "";
    }
}

/* End of file Base_Controller.php */
/* Location: application/core/Base_Controller.php */

<?php

/**
 * The portfolio page controller.
 *
 * controllers/Portfolio.php
 */
 class Portfolio extends Base_Controller
 {
    function __construct()
    {
        parent::__construct();
        $this->load->model('players');
        $this->load->model('collections');
        $this->load->model('transactions');
    }
    
    function index($selected_name = null)
    {
        $this->select($selected_name);
    }
    
    function select($selected_name = null)
    {
        $page_data = array();
        
        if ($selected_name == null && $this->is_logged_in())
            $selected_name = $this->get_username();
        
        $page_data['player_names'] = $this->build_player_names_dropdown($selected_name);

        if ($selected_name != null)
        {
            $page_data['collection'] = $this->build_collection($selected_name);
            $page_data['trades'] = $this->build_trades($selected_name);
        }
        else
        {
            $page_data['collection'] = "";
            $page_data['trades'] = "";
        }
        
        $this->data['content'] = $this->parser->parse('portfolio', $page_data, true);
        $this->render();
    }
    
    private function build_player_names_dropdown($selected_name)
    {
        $player_names = $this->players->get_names();
        $player_names_wrapper = array();
        
        foreach ($player_names as $name)
        {
            array_push($player_names_wrapper, array('name' => $name));
        }
        
        // The only example we have to go by does it this way, there has to be a cleaner way
        $player_names_wrapper_wrapper = array('player_names' => $player_names_wrapper);
        
        $player_names_wrapper_wrapper['player_name_selected'] = ($selected_name != null) ? $selected_name : "";
        
       return $this->parser->parse('_player_names', $player_names_wrapper_wrapper, true);
    }
    
    private function build_collection($selected_name)
    {
        $counts = $this->collections->get_as_numbered_array($selected_name);
        
        $str = "";
        
        for ($i = 0; $i < 3; $i++)
        {
            $str = $str . '<tr>';
            for ($j = 0; $j < 3; $j++)
            {
                $img = "<img src='/assets/img/11" . chr($j + ord('a')) . '-' . $i . ".jpeg'/>";
                $str = $str . '<td>' . $img . '<br/>' . $counts[$j][$i] . '</td>';
            }
            $str = $str . '</tr>';
        }
        
        return $str;
    }
    
    private function build_trades($selected_name)
    {
        $trades = $this->transactions->get_by_user($selected_name);
        $trades_wrapper = array();
     
        foreach ($trades as $trade)
        {
            array_push($trades_wrapper, array('date' => $trade->DateTime, 'type' => $trade->Trans, 'series' => $trade->Series));
        }
        
        // The only example we have to go by does it this way, there has to be a cleaner way
        $trades_wrapper_wrapper = array('trades' => $trades_wrapper);
       return $this->parser->parse('_trades', $trades_wrapper_wrapper, true);
    }
 }
 
 /* End of file Portfolio.php */
 /* Location: application/controllers/Portfolio.php */
 
<?php

/**
 * The homepage controller.
 *
 * controllers/Home.php
 */
 class Home extends Base_Controller
 {
    function __construct()
    {
        parent::__construct();
        $this->load->model('players');
        $this->load->model('collections');
    }
    
    function index()
    {
        $data = array(
            'players' => $this->build_players(),
            'known_pieces' => $this->build_known_pieces(),
        );
        
        $this->data['content'] = $this->parser->parse('home', $data, true);
        $this->render();
    }
    
    /**
     * Makes table rows for player's names (linking to their portfolio), how many bot pieces
     * they have, and their number of Peanuts
     */
    private function build_players()
    {
        $html = '';
        $players = $this->players->get_all();
     
        foreach ($players as $player)
        {
            $link = '<a href="portfolio/select/'. $player->Player .'">'. $player->Player .'</a>';
            
            $html = $html .'<tr><td>'. $link .'</td><td>'. count($this->collections->get_by_user($player->Player)) .'</td><td>'.
                $player->Peanuts .'</td></tr>';
        }
        
        return $html;
    }
    
    /**
     * Makes table rows for bot pieces the client knows about from the database
     */
    private function build_known_pieces()
    {
        $html = '<tr>';
        $pieces = $this->collections->get_pieces_present();
        
        for ($i = 0; $i < count($pieces); $i++)
        {
            $piece = $pieces[$i];
            
            $html = $html . '<td><img src="/assets/img/' . $piece . '.jpeg"/><br/>' . $piece . '</td>';
        
            // New row every 3 pieces, as long as there are more pieces to show
            $j = $i + 1;
            if ($i != 0 and $j%3 == 0 and $j < count($pieces))
                $html = $html . '</tr><tr>';
        }
        
        $html = $html . '</tr>';
        
        return $html;
    }
 }
 
 /* End of file Home.php */
 /* Location: application/controllers/Home.php */
 

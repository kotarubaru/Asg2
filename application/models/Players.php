<?php

/**
 * The players model.
 * Retrieves data from the 'players' table in the database.
 *
 * models/Players.php
 */
class Players extends Base_Model
{
    function __construct()
    {
        parent::__construct('players');
    }
    
    /**
     * Retrieves the entire contents of the 'players' table.
     */
    function get_all()
    {
        return $this->select_all();
    }
    
    /**
     * Retrieves the names of all of the players in the database as a simple array.
     */
    function get_names()
    {
        $players = $this->select_all();
        $output = array();
        
        foreach ($players as $player)
        {
            array_push($output, $player->Player);
        }
        
        return $output;
    }
}

 /* End of file Players.php */
 /* Location: application/models/Players.php */

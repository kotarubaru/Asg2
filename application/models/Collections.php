<?php

/**
 * The collections model.
 * Retrieves data from the 'collections' table in the database.
 *
 * models/Collections.php
 */
class Collections extends Base_Model
{
    function __construct()
    {
        parent::__construct('collections');
    }
    
    /**
     * Retrieves information about all the pieces in the possession of a particular player.
     */
    function get_by_user($user)
    {
        return $this->select_where_equal('Player', $user);
    }
    
    /**
     * Retrieves the contents of the collections table as an array of arrays;
     * Each index in the main array corresponds to a particular bot model ($type, here),
     * represented by an array in which each index corresponds to a particular piece, 
     * such as 0 for the head.
     */
    function get_as_numbered_array($user)
    {
        $counts = array(
            array(0, 0, 0),
            array(0, 0, 0),
            array(0, 0, 0),
        );
        
        $collection = $this->get_by_user($user);
        
        foreach ($collection as $piece)
        {
            $id = $piece->Piece;
            $type = substr($id, 2, 1);
            $num = substr($id, 4, 1);
            
            $type = ord($type) - ord('a');
            
            $counts[$type][$num]++;
        }
        
        return $counts;
    }
    
    /**
     * Retrieves the pieces present in the collections table across all players as a simple array.
     */
    function get_pieces_present()
    {
        $pieces = $this->select_all_grouped('Piece');
        $out = array();
        
        foreach ($pieces as $piece)
        {
            array_push($out, $piece->Piece);
        }
        
        return $out;
    }
}

 /* End of file Collections.php */
 /* Location: application/models/Collections.php */

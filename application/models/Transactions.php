<?php

/**
 * The transactions model.
 * Retrieves data from the 'transactions' table in the database.
 *
 * models/Transactions.php
 */
class Transactions extends Base_Model
{
    function __construct()
    {
        parent::__construct('transactions');
    }
    
    /**
     * Retrieves the ten most recent transactions for a particular user.
     * Transactions are listed in descending order, with the most recent at the top.
     */
    function get_by_user($user)
    {
        $this->limit_next(10);
        return $this->select_ordered('Player', $user, 'DateTime');
    }
}

 /* End of file Transactions.php */
 /* Location: application/models/Transactions.php */


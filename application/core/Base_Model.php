<?php

/**
 * core/Base_Model.php
 *
 * Default model
 */
class Base_Model extends CI_Model
{
    protected $tableName;
    
    function __construct($tableName = null)
    {
        parent::__construct();
        
        if ($tableName == null)
            $this->tableName = get_class($this);
        else
            $this->tableName = $tableName;
    }
    
    function select_where_equal($key, $value)
    {
        $this->db->where($key, $value);
        return $this->select_all();
    }
    
    function select_ordered($key, $value, $orderKey, $order = null)
    {
        $this->db->order_by($orderKey, ($order != null) ? $order : 'desc');
        return $this->select_where_equal($key, $value);
    }
    
    function select_all()
    {
        $query = $this->db->get($this->tableName);
        return $query->result();
    }
    
    function select_all_grouped($groupKey)
    {
        $this->db->group_by($groupKey);
        return $this->select_all();
    }
    
    function limit_next($amt)
    {
        $this->db->limit($amt);
    }
}
 
/* End of file Base_Model.php */
/* Location: application/core/Base_Model.php */

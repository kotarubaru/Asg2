<?php

/**
 * The bot assembly page controller.
 *
 * controllers/Assembly.php
 */
 class Assembly extends Base_Controller
 {
    function __construct()
    {
        parent::__construct();
        $this->load->model('collections');
    }
    
    function index()
    {
        $page_data = array();
        
        if (!$this->is_logged_in())
        {
            $page_data['assemble_pieces'] = "You must be logged in to assemble a bot.";
        }
        else
        {
            $page_data['assemble_pieces'] = $this->build_assemble_pieces();
        }
        
        $this->data['content'] = $this->parser->parse('assembly', $page_data, true);
        $this->render();
    }

    /*
    ** Displays an assembled bot. Occurs when the user clicks the 'assemble' button.
    ** The arguments are minimal piece reference strings, for example 'a-0'.
    */
    function pieces($head, $body, $feet)
    {
        if ($head == null || $body == null || $feet == null)
        {
            $this->index();
            return;
        }
        
        $page_data = array(
            'head' => '<img src="/assets/img/11' . $head . '.jpeg"/>',
            'body' => '<img src="/assets/img/11' . $body . '.jpeg"/>',
            'feet' => '<img src="/assets/img/11' . $feet . '.jpeg"/>',
        );
        
        $this->data['content'] = $this->parser->parse('assembled_bot', $page_data, true);
        $this->render();
    }

    /**
     * Method for displaying the bot pieces available to the logged in user.
     * Each row is for a different piece type: head, body, feet.
     */
    private function build_assemble_pieces()
    {
        $counts = $this->collections->get_as_numbered_array($this->get_username());
        
        $section_data = array();
        
        $section_data['heads'] = $this->build_assemble_pieces_row($counts, 0, 'head');
        $section_data['bodies'] = $this->build_assemble_pieces_row($counts, 1, 'body');
        $section_data['feet'] = $this->build_assemble_pieces_row($counts, 2, 'feet');
        
        return $this->parser->parse('_assemble_pieces', $section_data, true);
    }

    /**
     * Helper method for build_assemble_pieces()
     */
    private function build_assemble_pieces_row($counts, $column, $slot_name)
    {
        $str = "";
        
        for ($i = 0; $i < 3; $i++)
        {
            $count = $counts[$i][$column];
            
            if ($count > 0)
            {
                $img = "<img src='/assets/img/11" . chr($i+ ord('a')) . '-' . $column . ".jpeg' data-slot='" . $slot_name . "'/>";
                $str = $str . '<td class="assemblePiece" ondragstart="drag(event)">' . $img . '<br/>' . $count . '</td>';
            }
        }
        
        return $str;
    }
 }
 
 /* End of file Assembly.php */
 /* Location: application/controllers/Assembly.php */
 

<?php
//-----------------------------------------------------------------------------
// Ajax контролер
//-----------------------------------------------------------------------------

Class Ajax extends Model {
    
    protected $response = array ('result' => 0);
    protected $settings = array ();
    
    public function __construct( $tpl ) {
        switch ($tpl) {
            case 'main': 
                $this->mainContent ();
            break;
            case 'title': 
                $this->getTitle ();
            break;
            default: 
                //-
            break;
        }
        
    }

    /**
     * Main content
    */
    public function mainContent () {
        // Url
        $hashUrl        = filter_var(substr($_GET['url'], 1), FILTER_SANITIZE_STRING);
        
        // Template 
        $template = $this->current_url_info_m($hashUrl);
        
        // Response
        $this->response = array(
            'result'    => 1,
            'content'   => file_get_contents(SITE_ADDR.'/'.LANG.'/'.$hashUrl),
            'template'  => $template['type_tpl'],
            'id'        => $template['id']
        );

        // View
        $this->view_json ();
    } 
	
	/**
     * Get title
    */
    public function getTitle () {
        // Url
        $hashUrl        = filter_var(substr($_GET['url'], 1), FILTER_SANITIZE_STRING);
        
        // Template 
        $template = $this->current_url_info_m($hashUrl);
        
        // Response
        $this->response = array(
            'result'    => 1,
            'title'     => $template['title_'.LANG] == "" ? $template['name_'.LANG] : $template['title_'.LANG],
            'meta_k'    => $template['meta_k_'.LANG],
            'meta_d'    => $template['meta_d_'.LANG]
        );

        // View
        $this->view_json ();
    }
    
    /**
     * Render for Ajax - JSON
    */
    protected function view_json () {
        // view
        echo json_encode($this->response);
    }
    
}
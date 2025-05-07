<?php

class Paginator {
    public $page = 1;
    public $per_page = 1;
    public $total = 1;
    public $mid_size = 2;
    public $all_pages = 10;
    public $pages_count = 1;
    public $uri = '';
    
    public function __construct($page = 1, $per_page = 1, $total = 1)
    {
        $this->page = $page;
        $this->per_page = $per_page;
        $this->total = $total;
        
        $this->pages_count = $this->getCountPages();
    }
    
    public function getCountPages()
    {
        return ceil($this->total / $this->per_page);
    }
} 
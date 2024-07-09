<?php 
/** 
 * CodexWorld is a programming blog. Our mission is to provide the best online resources on programming and web development. 
 * 
 * This Pagination1 class helps to integrate ajax Pagination1 in PHP. 
 * 
 * @class        Pagination1 
 * @author        CodexWorld 
 * @link        http://www.codexworld.com 
 * @contact        http://www.codexworld.com/contact-us 
 * @version        1.0 
 */ 
class Pagination1{ 
    var $baseURL        = ''; 
    var $totalRows      = ''; 
    var $perPage        = 10; 
    var $numLinks       =  3; 
    var $currentPage    =  0; 
    var $firstLink      = '&lsaquo; First'; 
    var $nextLink       = '&gt;'; 
    var $prevLink       = '&lt;'; 
    var $lastLink       = 'Last &rsaquo;'; 
    var $fullTagOpen    = '<ul class="Pagination1">'; 
    var $fullTagClose   = '</ul>'; 
    var $firstTagOpen   = ''; 
    var $firstTagClose  = ''; 
    var $lastTagOpen    = ''; 
    var $lastTagClose   = ''; 
    var $curTagOpen     = '<li class="page-item active"><a href="#" class="page-link">'; 
    var $curTagClose    = '</a></li>'; 
    var $nextTagOpen    = ''; 
    var $nextTagClose   = ''; 
    var $prevTagOpen    = ''; 
    var $prevTagClose   = ''; 
    var $numTagOpen     = ''; 
    var $numTagClose    = ''; 
    var $anchorClass    = 'page-link'; 
    var $showCount      = true; 
    var $currentOffset  = 0; 
    var $contentDiv     = ''; 
    var $additionalParam= ''; 
    var $link_func      = ''; 
     
    function __construct($params = array()){ 
        if (count($params) > 0){ 
            $this->initialize($params);         
        } 
         
        if ($this->anchorClass != ''){ 
            $this->anchorClass = 'class="'.$this->anchorClass.'" '; 
        }     
    } 
     
    function initialize($params = array()){ 
        if (count($params) > 0){ 
            foreach ($params as $key => $val){ 
                if (isset($this->$key)){ 
                    $this->$key = $val; 
                } 
            }         
        } 
    } 
     
    /** 
     * Generate the Pagination1 links 
     */     
    function createLinks(){  
        // If total number of rows is zero, do not need to continue 
        if ($this->totalRows == 0 OR $this->perPage == 0){ 
           return ''; 
        } 
 
        // Calculate the total number of pages 
        $numPages = ceil($this->totalRows / $this->perPage); 
 
        // Is there only one page? will not need to continue 
        if ($numPages == 1){ 
            if ($this->showCount){ 
                $info = '<p>Showing : ' . $this->totalRows.'</p>'; 
                return $info; 
            }else{ 
                return ''; 
            } 
        } 
 
        // Determine the current page     
        if ( ! is_numeric($this->currentPage)){ 
            $this->currentPage = 0; 
        } 
         
        // Links content string variable 
        $output = ''; 
         
        // Showing links notification 
        if ($this->showCount){ 
           $currentOffset = $this->currentPage; 
           $info = 'Showing ' . ( $currentOffset + 1 ) . ' to ' ; 
         
           if( ($currentOffset + $this->perPage) < $this->totalRows) 
              $info .= $currentOffset + $this->perPage; 
           else 
              $info .= $this->totalRows; 
         
           $info .= ' of ' . $this->totalRows . '  '; 
         
           $output .= $info; 
        } 
         
        $this->numLinks = (int)$this->numLinks; 
         
        // Is the page number beyond the result range? the last page will show 
        if ($this->currentPage > $this->totalRows){ 
            $this->currentPage = ($numPages - 1) * $this->perPage; 
        } 
         
        $uriPageNum = $this->currentPage; 
         
        $this->currentPage = floor(($this->currentPage/$this->perPage) + 1); 
 
        // Calculate the start and end numbers.  
        $start = (($this->currentPage - $this->numLinks) > 0) ? $this->currentPage - ($this->numLinks - 1) : 1; 
        $end   = (($this->currentPage + $this->numLinks) < $numPages) ? $this->currentPage + $this->numLinks : $numPages; 
 

        
         
        return $output;         
    } 
 
  
} 
?>
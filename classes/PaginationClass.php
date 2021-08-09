<?php
/*Paginacja by Arxlaz*/
    class Pagination {
        
        protected $_namePage;
        protected $_currentPage;
        protected $_totalPage;
        protected $_maxPage;
        protected $_calculateTotalPage;   
        
        protected $_limitResults = 1000;
        
        protected $_templateAct = '';
        protected $_templateDct = '';
                
        public function __construct($namePage, $totalPage, $maxPage) {
            $this->_namePage = $namePage;
            $this->_currentPage = (int) $_GET[$this->_namePage];
            $this->_totalPage = (int) $totalPage;
            $this->_maxPage = (int) $maxPage;
            
            $this->_calculateTotalPage = self::calculateTotal($this->_totalPage, $this->_maxPage);
            
            if ($this->_currentPage <= 0) { $this->_currentPage = 1; }
            elseif($this->_currentPage > $this->_calculateTotalPage) {
                $this->_currentPage = 1;
            }
        }
        
        static protected function calculateTotal($totalPage, $maxPage) {
            return ceil($totalPage/$maxPage);   
        }
                
        public function getCurrentPage() {
            return $this->_currentPage;
        }
        
        public function getTotalPage() {
            return $this->_totalPage;
        }
        
        public function getMaxPage() {
            return $this->_maxPage;
        }
        
        public function setLimitResults($limit) {
            $this->_limitResults = (int) $limit;       
        }
        
        public function definePattern($pattern, $type=0) {
            $pat = array('{P}', '{LP}');
            $rep = array('%1$s','%2$d');
            
            $subject = str_replace($pat, $rep, $pattern);
            
            if ($type == 0) {
                $this->_templateDct = $subject;
            }
            else {
                $this->_templateAct = $subject;
            }
            
        }
        
        protected function make() {
            
            if ($this->_limitResults <= $this->_calculateTotalPage) {
                $absValue = $this->_limitResults/2;
                ($this->_limitResults %2 == 0) ? ($absValue=$absValue-0.5) : ($absValue=$absValue-0.5);   
                
                $start = $this->_currentPage - $absValue;
                $finish = $this->_currentPage + $absValue;
                

                if (($this->_currentPage-$absValue) <= 1) {
                    $difference = $this->_currentPage-$absValue - 1;
                    $start = $start - $difference;
                    $finish = $finish - $difference;
                }

                if (($this->_currentPage+$absValue) > $this->_calculateTotalPage) {
                    $difference = ($this->_currentPage+$absValue)-($this->_calculateTotalPage);
                    $start = $start - $difference;
                    $finish = $finish - $difference;
                }
            }
            else {
                $start = 1;
                $finish = $this->_calculateTotalPage;
            }       
            
            return array('start'=>$start, 'finish'=>$finish);           
        }
        
        public function display() {
            
            $iterator = $this->make();
            
            $render = '';
            
            for($i=ceil($iterator['start']); $i<=ceil($iterator['finish']); $i++) {
                 if ($i != $this->_currentPage) {
                    $render .= sprintf($this->_templateDct, $this->_namePage, $i);
                 }
                else {
                    $render .= sprintf($this->_templateAct, $this->_namePage, $i);
                }
            }
            
            return $render;
            
        }           
        
    }
    
    class PaginationDB extends Pagination {
        public function sqlLimit() {
            return ($this->_currentPage-1) * $this->_maxPage . ',' . $this->_maxPage;
        }
    }

?>
<?php

/**
* Author : areoid a.k.a areg_noid | areg_noid@yahoo.com
* Filename : Pagination Class
* Pubblished : August 5th, 2016
*/

class Pagination {
	private $_total, $_per_page, 
			$_page, $_base_page_url,
			$_page_url			= null;
	private $_ul_class = 'pagination no-margin';
  
	/**
	* Setup pagination config
	* @params array
	* @return void
	*/
	public function paginationSetup($setup) {
		$this->_total         = $setup['total'];
		$this->_per_page      = $setup['per_page'];
		$this->_page          = $setup['page'];
		$this->_base_page_url = $setup['base_page_url'];
		$this->_page_url      = $setup['page_url'];
		$this->_ul_class      = !empty($setup['ul_class']) ? $setup['ul_class'] : $this->_ul_class;
		$this->_show_number   = 5;
	}
  
	/**
	* Rendering pagination script
	* @return string
	*/
	public function createPaginationLink() {
		$max_page = ceil($this->_total / $this->_per_page);

		if($this->_page < $this->_show_number) {
			$low_num  = 1;
			$end = $low_num + ($this->_show_number - 1);
			$high_num = ($end > $max_page) ? $max_page : $end;
		}
		elseif(($this->_page+2) < $max_page) {
			$low_num  = $this->_page - 2;
			$end      = $low_num + ($this->_show_number - 1);
			$high_num = ($end > $max_page) ? $max_page : $end;
		}
		elseif(($this->_page+1) < $max_page) {
			$low_num  = ceil($this->_show_number/2) + 1;
			$end      = $low_num + ($this->_show_number - 1);
			$high_num = ($end > $max_page) ? $max_page : $end;
			if($this->_page > $high_num) {
				$low_num  = $this->_page - ($this->_show_number - 2 );
				$end      = $low_num + ($this->_show_number - 1);
				$high_num = ($end > $max_page) ? $max_page : $end;
			}
		}
		elseif($this->_page == $max_page) {
			$low_num  = $this->_page - $this->_show_number + 1;
			$high_num = $max_page;
		}
		elseif(($max_page - $this->_page) == 1) {
			$low_num  = $this->_page - ($this->_show_number - 2 );
			$end      = $low_num + ($this->_show_number - 1);
			$high_num = ($end > $max_page) ? $max_page : $end;
		}

		$script_pagination = '<ul class="'.$this->_ul_class.'">';

		// prev
		if($this->_page > 1) {			
			$prev     = $this->_page-1;
			$url_prev = $prev == 1 ? $this->_base_page_url : $this->_page_url.$prev;
			$script_pagination .= '<li><a rel="prev" href="'.$url_prev.'">&laquo; Prev</a></li>';
		}
		for($i = $low_num; $i <= $high_num; $i++) {
			if($i == $this->_page) {
				$script_pagination .= '<li class="active"><a href="'.$this->_page_url.$i.'">'.$i.'</a></li>';
			}
			else {
				$list_page_url = $i == 1 ? $this->_base_page_url : $this->_page_url.$i;
				$script_pagination .= '<li><a href="'.$list_page_url.'">'.$i.'</a></li>';
			}
		}
		// next
		if($this->_page < $max_page) {
			$next = $this->_page+1;
			$script_pagination .= '<li><a rel="next" href="'.$this->_page_url.$next.'">Next &raquo;</a></li>';
		}

		$script_pagination .= '</ul>';
		
		return $script_pagination;

	}

}

// EOF

<?php 
	class EventModelsHome extends FSModels
	{
		function __construct(){
			
		parent::__construct();
		global $module_config;
		FSFactory::include_class('parameters');
		$current_parameters = new Parameters($module_config->params);
		$limit   = $current_parameters->getParams('limit'); 
        $limit = 6;
		$this->limit = $limit;
        $fs_table = FSFactory::getClass('fstable');
        $this->table_name = $fs_table -> getTable('fs_event');
        // $this->table_cat = $fs_table -> getTable('fs_news_categories');
		}
		/*
		 * select cat list is children of catid
		 */
		function set_query_body()
		{
			$date1  = FSInput::get("date_search");
			$where  = "";
			$fs_table = FSFactory::getClass('fstable');
			$query = " FROM ".$fs_table -> getTable('fs_event')."
						  WHERE 
						  	 published = 1
						  	". $where.
						    " ORDER BY  ordering DESC,created_time DESC, id DESC 
						 ";
			return $query;
		}
		
		function get_list($query_body)
		{
			if(!$query_body)
				return;
			global $db;
			$query = " SELECT id,title,summary,image, created_time,category_id, category_alias, alias,place,time_event";
			$query .= $query_body;
			$sql = $db->query_limit($query,$this->limit,$this->page);
			$result = $db->getObjectList();
			return $result;
		}

		function get_sukiensapdienra()// mẫu hàm để gọi chính xác 1 mảng
		{ 
			$query = "SELECT * FROM ".$this->table_name." WHERE published = 1 AND show_in_homepage = 1  ORDER BY time_event  DESC";//câu lệnh truyền vào pải chỉ rõ đang gọi đến 1 đối tượng nào
			global $db;
			$db->query($query);
			$result = $db->getObject();
			return $result;
		}

	

		function mauham1phantu()// mẫu hàm để gọi chính xác 1 mảng
		{
			$query = "SELECT * FROM ".$this->table_name." WHERE published = 1 and id = 10";//câu lệnh truyền vào pải chỉ rõ đang gọi đến 1 đối tượng nào
			global $db;
			$db->query($query);
			$result = $db->getObject();
			return $result;
		}

		function get_show_home()
		{
			$query = "SELECT * FROM ".$this->table_name." WHERE published = 1 and show_in_homepage = 1 ORDER BY created_time DESC";//câu lệnh truyền vào pải chỉ rõ đang gọi đến 1 đối tượng nào
			global $db;
			$db->query($query);
			$result = $db->getObjectList();
			return $result;
		}

		function get_tinnoibat1($id)// mẫu hàm để gọi chính xác 1 mảng
		{
			$query = "select * FROM ".$this->table_name."
						  WHERE 
						  	 published = 1 and category_id = ".$id." and is_hot = 1 ORDER BY  ordering DESC,created_time DESC, id DESC limit 4
						 ";
			global $db;
			$db->query($query);
			$result = $db->getObjectList();
			return $result;
		}


		function get_tinnoibat()// mẫu hàm để gọi chính xác 1 mảng
		{
			$query = "SELECT * FROM ".$this->table_cat." WHERE published = 1 AND parent_id = 0 AND id != 11";//câu lệnh truyền vào
			global $db;
			$db->query($query);
			$result = $db->getObjectList();
			return $result;
		}
		
		/*
		 * return products list in category list.
		 * These categories is Children of category_current
		 */

		function getTotal($query_body)
		{
			if(!$query_body)
				return ;
			global $db;
			$query = "SELECT count(*)";
			$query .= $query_body;
			$sql = $db->query($query);
			$total = $db->getResult();
			return $total;
		}
		
		function getPagination($total)
		{
			FSFactory::include_class('Pagination');
			$pagination = new Pagination($this->limit,$total,$this->page);
			return $pagination;
		}
	}
	
?>
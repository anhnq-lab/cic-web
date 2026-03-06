
<?php 
	class HomeModelsHome extends FSModels
	{
		/*
		 * select cat list is children of catid
		 */
		function __construct()
		{
			parent::__construct();
			global $module_config;
			FSFactory::include_class('parameters');
			$current_parameters = new Parameters($module_config->params);
			$limit   = $current_parameters->getParams('limit'); 
			$limit = 4;
			$this->limit = $limit;
			$fs_table = FSFactory::getClass('fstable');
			$this->table_name = $fs_table -> getTable('fs_event');

			
		}

		function get_sukiensapdienra()// mẫu hàm để gọi chính xác 1 mảng
		{ 
			$query = "SELECT * FROM ".$this->table_name." WHERE published = 1 AND show_in_home = 1  ORDER BY time_event  DESC";//câu lệnh truyền vào pải chỉ rõ đang gọi đến 1 đối tượng nào
			global $db;
			$db->query($query);
			$result = $db->getObject();
			return $result;
		}

	}
	
?>
<?php
/*
 * Huy write
 */
	// controller
	
	class EventControllersHome extends FSControllers
	{
		function display()
		{
			// call models
			$model = $this -> model;

			global $tags_group;
			
			$query_body = $model->set_query_body();
			// var_dump($query_body); nm 

			$list = $model->get_list($query_body);
		
			$sukiensapdienra = $model -> get_sukiensapdienra();
		
			$total = $model->getTotal($query_body);
			$pagination = $model->getPagination($total);
			 
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=> FSText::_('Sự kiện'), 1 => FSRoute::_('index.php?module=event&view=event&Itemid=33'));
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			$tmpl -> set_seo_special();
			// echo 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
			// call views
			// echo 'modules/'.$this->module.'/views/'.$this->view.'/default.php';			
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';

		}
		
	}
	
?>
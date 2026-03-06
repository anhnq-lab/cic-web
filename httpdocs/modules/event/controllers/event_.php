<?php
/*
 * Huy write
 */
	// controller

	class EventControllersEvent extends FSControllers
	{
		var $module;
		var $view;
		function display()
		{
			// call models
			$model = $this -> model;

			$data = $model->getEvent();
		

			if(!$data)
				setRedirect(URL_ROOT,'Không tồn tại bài viết này','Error');
			$ccode = FSInput::get('ccode');

		
			$is_home = $model->getis_hot();

			$sukienchitiet = $model->getsukienchitiet();

			$sukiennoibat = $model ->get_sukiennoibat();
	
			$Itemid = 7;
		
            $event_related = $model->get_event_related($data->event_related,$data->id);
            $products_related = $model->get_products_related($data->products_related);
            $news_related = $model->get_news_related($data->news_related);
		
            $link = FSRoute::_('index.php?module=news&view=news&code=' . $data->alias . '&id=' . $data->id);

			$str = $data->tags;
			$tag1 = explode(',', $str);

			$breadcrumbs = array();
	
			$breadcrumbs[] = array(0=>$category -> name, 1 => FSRoute::_('index.php?module=news&view=cat&id='.$data -> category_id.'&ccode='.$data -> category_alias));

			global $tmpl,$module_config;
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			$tmpl -> assign('title', $data->title);
			$tmpl -> assign('tags', $data->tags);
			$tmpl -> assign('og_image', URL_ROOT.str_replace('/original/', '/large/', $data -> image));
			$tmpl -> assign('og_url', $link);

			// seo
			$tmpl -> set_data_seo($data);

			// call views
		include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}

		// check captcha
		function check_captcha(){
			$captcha = FSInput::get('txtCaptcha');

			if ( $captcha == $_SESSION["security_code"]){
				return true;
			} else {
			}
			return false;
		}

		function rating(){
			$model = $this -> model;
			if(!$model -> save_rating()){
				echo '0';
				return;
			} else {
				echo '1';
				return;
			}
		}
		function count_views(){
			$model = $this -> model;
			if(!$model -> count_views()){
				echo 'hello';
				return;
			} else {
				echo '1';
				return;
			}
		}
		// update hits
		function update_hits(){
			$model = $this -> model;
			$news_id = FSInput::get('id');
			$model -> update_hits($news_id);
		}

	}

?>

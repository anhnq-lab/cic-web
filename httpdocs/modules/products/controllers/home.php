<?php

/**
 * author: AnhPT
 * date:   2018-11-30 05:07 AM
 * Class ProductsControllersHome
 */
class ProductsControllersHome extends FSControllers
{

    function display()
    {
        // call models
        $model = $this->model;

        // breadcrumbs
        $breadcrumbs = array();
        $breadcrumbs [] = array(0 => FSText::_('Tất cả sản phẩm'), 1 => '');
        $bcr_lv = $model->getproducts_lv();

        global $tmpl, $module_config;
        $tmpl->assign('breadcrumbs', $breadcrumbs);
        // seo
        $tmpl->set_seo_special();

        // Linh vuv
        $products_categories = $model->getproducts_categories();
        $products_categories_orther = $model->getproducts_categories_orther();
        $result_cat = array_merge($products_categories, $products_categories_orther);

        // Hang sx
        $products_manufactories = $model->getproducts_manufactories();
        $products_manufactories_other = $model->getproducts_manufactories_other();
        $result_manufactories = array_merge($products_manufactories, $products_manufactories_other);

        // Ung dung
        $products_application = $model->getproducts_application();
        $products_application_orther = $model->getproducts_application_orther();
        $result_app = array_merge($products_application, $products_application_orther);

        // Loai sp
        $products_types = $model->getproducts_types();
        $products_types_orther = $model->getproducts_types_orther();
        $result_types = array_merge($products_types, $products_types_orther);

        $city = $model->getcity();

        $products_az = $model->getproducts_az();

        include 'modules/' . $this->module . '/views/' . $this->view . '/default.php';
    }

    function product_list()
    {
        // call models
        $model = $this->model;
        $query_body = $model->set_query_body();

        $list = $model->get_list($query_body);

        $total = $model->getTotal();

        // Lấy config banner
        $global = new FsGlobal();

        $banner_bundle = $global->getConfig("product_bundle_banner");
        $banner_full_width = $global->getConfig("product_full_width_banner");

        $pagination = $model->getPagination($total);
//        $products_hot = $model->getproducts_hot();
        $products_all = $model->getproducts_all();

        $products_types = $model->getproducts_types();
        $products_types_orther = $model->getproducts_types_orther();
        $result_types = array_merge($products_types, $products_types_orther);

        $city = $model->getcity();

        include 'modules/' . $this->module . '/views/' . $this->view . '/products_list.php';
    }
}
?>

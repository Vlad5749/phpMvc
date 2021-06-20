<?php
namespace Controllers;

use Core\Controller;
use Core\View;
use Core\Helper;

/**
 * Class ProductController
 */
class ProductController extends Controller
{
    public function indexAction()
    {
        $this->forward('product/list');
    }

    /**
     *
     */
    public function listAction()
    {
        $this->set('title', "Товари");
        $filterParam = $this->getFilterParams();
            $products = $this->getModel('Product')
                ->initCollection()
                ->filter($filterParam)
                ->sort($this->getSortParams())
                ->getCollection()
                ->select();
        $this->set('products', $products);
        
        $max = $this->getModel('Product')->getMax('price');
        
        $from = $filterParam['price'][0];
        $this->set('from', $from);
        
        $to = $filterParam['price'][1];
        $this->set('to', $to);
        
        if (!isset($to)) {
            $to = $max;
            $this->set('to', $to);
        }
        
        $this->renderLayout();
    }

     /**
     * @return array
     */
    public function getSortParams()
    {
        $params = [];
        $sort = filter_input(INPUT_POST, 'sort');
        
        if (!$sort) {
            if (isset($_COOKIE['select'])) {
                $sort = $_COOKIE['select'];
            } else {
                $sort = 'name_ASC';
                setcookie('select', $sort);
            }
        } else {
            setcookie('select', $sort);
        }
            
        if ($sort === "price_DESC") {
            $params['price'] = 'DESC';
        } elseif ($sort === "price_ASC") {
            $params['price'] = 'ASC';
        } elseif ($sort === "qty_DESC") {
            $params['qty'] = 'DESC';
        } elseif ($sort === 'qty_ASC') {
            $params['qty'] = 'ASC';
        } elseif ($sort === 'name_ASC') {
            $params['name'] = 'ASC';
        }
        return $params;
    }
    
    public function getFilterParams()
    {
        $from = filter_input(INPUT_POST, 'from', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $to = filter_input(INPUT_POST, 'to', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        if (isset($from) && isset($to)) {
            $params['price'] = [$from, $to];
        } else {
            $params['price'] = [0, null];
        }
        return $params;
    }
    
    /**
     *
     */
    public function viewAction()
    {
        $this->set('title', "Карточка товара");
        $product = $this->getModel('Product');
        $this->set('product', $product->getItem($this->getId()));
        $this->renderLayout();
    }
    
    /**
     *
     */
    public function editAction()
    {
        if (!Helper::isAdmin()) {
            $this->redirect("/product/list");
            return;
        }
        $model = $this->getModel('Product');
        $this->set('saved', 0);
        $this->set("title", "Редагування товару");
        
        if ((filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST')) {
            $values = $model->getPostValues();
            $this->set('saved', 1);
            $model->saveItem($this->getId(), $values);
            $this->redirect("/product/message?text=Редагування пройшло успішно");
        }
        $this->set('product', $model->getItem($this->getId()));
        
        $this->renderLayout();
    }

    public function deleteAction() 
    {
        if (!Helper::isAdmin()) {
            $this->redirect("/product/list");
            return;
        }
        $model = $this->getModel('Product');
        $this->set("title", "Видалення товару");
        $confirm = filter_input(INPUT_POST, 'confirm');
        $id = $this->getId();
        if ($confirm === "Так") {
            $model->deleteItem($id);
            $this->redirect("/product/list");
        } elseif ($confirm === "Ні") {
            $this->redirect("/product/edit?id=$id");
        }
        $this->renderLayout();
    }
    /**
     *
     */
    public function addAction()
    {
        if (!Helper::isAdmin()) {
            $this->redirect("/product/list");
            return;
        }
        $model = $this->getModel('Product');
        $this->set("title","Додавання товару");
        if (($values = $model->getPostValues())) {
            $model->addItem($values);
            $products = $this->getModel('Product')
                ->initCollection()
                ->sort(array("id" => "DESC"))
                ->getCollection()
                ->select();
            $this->set('products', $products);
            $id = $products[0]['id'];
            $this->redirect("/product/edit?id=$id");
        }
        $this->renderLayout();
    }

    public function messageAction() 
    {
        $this->set("title", "Повідомлення");
        $confirm = filter_input(INPUT_POST, 'confirm');
        if ($confirm === "Повернутись до списку товарів") {
            $this->redirect("/product/list");
        }
        $this->renderLayout();
    }

    /**
     * @return array
     */
    public function getSortParams_old()
    {
        /*
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else 
        { 
            $sort = "name";
        }
         * 
         */
        $sort = filter_input(INPUT_GET, 'sort');
        if (!isset($sort)) {
            $sort = "name";
        }
        /*
        if (isset($_GET['order']) && $_GET['order'] == 1) {
            $order = "ASC";
        } else {
            $order = "DESC";
        }
         * 
         */
        if (filter_input(INPUT_GET, 'order') == 1) {
            $order = "DESC";
        } else {
            $order = "ASC";
        }
        
        return array($sort, $order);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        /*
        if (isset($_GET['id'])) {
         
            return $_GET['id'];
        } else {
            return NULL;
        }
        */
        return filter_input(INPUT_GET, 'id');
    }

    public function unloadAction()
    {
        $this->set('title', "Експорт");
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
            $confirm = filter_input(INPUT_POST, 'confirm');
            if ($confirm === "Так") {
                $products = $this->getModel('Product')
                ->initCollection()
                ->getCollection()->select();

                $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><products/>');

                foreach ($products as $product) {
                    $xmlProduct = $xml->addChild('product');
                    $xmlProduct->addChild('id',$product['id']);
                    $xmlProduct->addChild('sku',$product['sku']);
                    $xmlProduct->addChild('name',$product['name']);
                    $xmlProduct->addChild('price',$product['price']);
                    $xmlProduct->addChild('qty',$product['qty']);
                    $xmlProduct->addChild('description',$product['description']);
                }
                //$xml->asXML('public/products.xml');

                $dom = new \DOMDocument("1.0");
                $dom->preserveWhiteSpace = false;
                $dom->formatOutput = true;
                $dom->loadXML($xml->asXML());
                //$dom->saveXML();

                $file = fopen('public/products.xml','w');
                fwrite($file, $dom->saveXML());
                fclose($file);
                $this->redirect("/product/message?text=Товари успішно експортовані в Xml-файл");
            } elseif ($confirm === "Ні") {
                $this->redirect("/product/list");
            }
        }
        $this->renderLayout();
    }
}

<?php
namespace Controllers;

use Core\Controller;

/**
 * Class IndexController
 */
class IndexController extends Controller
{

    /**
     *
     */
    public function indexAction()
    {
        $this->set("title", "Test shop");
        if (isset($_SESSION['id'])) {
            $customer = $this->getModel('Customer')
                ->getItem($_SESSION['id']);
            $this->set('customer', $customer);
        }
        $this->renderLayout();
    }

    /**
     *
     */
    public function testAction()
    {
        echo "hello from testAction";
    }
    
    

}
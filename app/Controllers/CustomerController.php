<?php
namespace Controllers;

use Core\Controller;
use Core\View;

class CustomerController extends Controller
{  
    public function listAction()
    {
        $this->set('title', "Клієнти");

        $customer = $this->getModel('Customer')
            ->initCollection()
            ->getCollection()
            ->select();
        $this->set('customer', $customer);

        $this->renderLayout();
    }
    
    public function userAction() 
    {
        $this->set('title', "Клієнт");
        $customer = $this->getModel('Customer');
        $this->set('customer', $customer->getItem($this->getId()));
        $this->renderLayout();
    }
    
    public function registrationAction()
    {
        $model = $this->getModel('Customer');
        $this->set("title","Реєстрація");
        $this->set("errors", true);
        
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST'){
            $values = $model->getPostValues();
            $validateValues = $values;
            $validateValues['confirm_password'] = filter_input(INPUT_POST, 
                "confirm_password", FILTER_SANITIZE_STRING);
            $isValid = $this->validator($validateValues);
            if ($isValid === true) {
                $values['password'] = md5($values['password']);
                $model->addItem($values);
                $this->redirect("/customer/login");
            } else {
                $this->set('errors', $isValid);
            }
        }
        $this->renderLayout();
    }

    public function Validator($values)
    {
        $errors = [];
        
        $columns = $this->getModel('Customer')->getColumns();
        array_shift($columns);
        array_pop($columns);
        array_push($columns, "confirm_password");
        
        foreach ($columns as $column) {
            if (!isset($values[$column])) {
                $errors[$column] = "Обов`язкове поле";
            }
        }
        
        if (isset($values['email'])) {
            if (!preg_match("/^[-a-zA-Z0-9\._]+@([a-zA-Z0-9]+\.)+[a-z]{2,4}$/", 
                    $values['email']) && !isset($errors['email'])) {
                $errors['email'] = "Некоректна електронна адреса";
            }
        }
        if (isset($values['password'])) {
            if (!preg_match("/^(?=.*\d)(?=.*[A-Za-z])([a-zA-Z0-9]{8,16})$/",
                    $values['password']) && !isset($errors['password'])) {
                $errors['password'] = "Некоректний пароль";
            }
        }
        if (isset($values['confirm_password']) && isset($values['password'])) {
            if (!($values['password'] === $values['confirm_password']) &&
                    !isset($errors['confirm_password'])) {
                $errors['confirm_password'] = "Не співпадають паролі";
            }
        }
        
        if (empty($errors)) {
            return true;
        } else {
            return $errors;
        }
    }

    public function LoginAction()
    {
        $this->set('title', "Вхід");
        $this->set("error", false);
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST')
        {
            $email = filter_input(INPUT_POST, 'email');
            $password = md5(filter_input(INPUT_POST, 'password'));
            $params =array (
                'email' => $email,
                'password' => $password
            );
            $customer = $this->getModel('customer')->initCollection()
                ->filter($params)
                ->getCollection()
                ->selectFirst();
            
            if(!empty($customer)) {
                $_SESSION['id'] = $customer['customer_id'];
                $_SESSION['last_name'] = $customer['last_name'];
                $_SESSION['first_name'] = $customer['first_name'];
                $this->redirect('/index/index');
            } else {
                $this->invalid_password = 1;
                $this->set("error", true);
            }
        }
        $this->renderLayout();
    }

    public function LogoutAction()
    {

        $_SESSION = [];

        // expire cookie

        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 3600, "/");
        }
        session_destroy();
        $this->redirect('/index/index');
    }
    
    public function getId()
    {
        return filter_input(INPUT_GET, 'id');
    }
}

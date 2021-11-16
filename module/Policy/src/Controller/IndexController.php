<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Policy\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	protected $table;

	public function __construct($table){
		$this->table = $table;
	}
    public function indexAction()
    {	
    	$policies = $this->table->fetchAll();

        return new ViewModel(['policies' => $policies]);
    }

    public function addAction(){

    	$form = new \Policy\Form\PolicyForm;
    	$request = $this->getRequest();
    	if(!$request->isPost()){
    		return new ViewModel(['form' => $form]);
    	}

    	$policy = new \Policy\Model\Policy();
    	$form->setData($request->getPost());
    	if(!$form->isValid()){
    		exit('id is not correct');
    	}

    	$policy->exchangeArray($form->getData());
    	$this->table->saveData($policy);
    	return $this->redirect()->toRoute('home', [
    		'controller' => 'home',
    		'action' => 'add'
    	]);
    	
    }

    public function viewAction(){
    	$id = (int) $this->params()->fromRoute('id', 0);
    	if($id == 0){
    		exit('Error');
    	}

    	try{
    		$policy = $this->table->getPost($id);
    	}catch(Exception $e){
    		exit('Error');
    	}

    	return new ViewModel([
    		'policy' => $policy,
    		'id' => $id
    	]);
    }

    public function editAction(){
    	$id = (int) $this->params()->fromRoute('id', 0);
    	if($id == 0){
    		exit('Error');
    	}

    	try{
    		$policy = $this->table->getPost($id);
    	}catch(Exception $e){
    		exit('Error');
    	}

    	$form = new \Policy\Form\PolicyForm;
    	$form->bind($policy);
    	$request = $this->getRequest();
    	if(!$request->isPost()){
    		return new ViewModel([
	    		'form' => $form,
	    		'id' => $id
	    	]);
    	}

    	$form->setData($request->getPost());
    	if(!$form->isValid()){
    		exit('Error');
    	}
	    
	    $this->table->saveData($policy);
	    return $this->redirect()->toRoute('home', [
	    	'controller' => 'edit',
	    	'action' => 'edit',
	    	'id' => $id
	    ]);
    }

    public function deleteAction(){

    	$id = (int) $this->params()->fromRoute('id', 0);
    	if($id == 0){
    		exit('Error');
    	}

    	try{
    		$policy = $this->table->getPost($id);
    	}catch(Exception $e){
    		exit('Error');
    	}

    	$request = $this->getRequest();
    	if(!$request->isPost()){
    		return new ViewModel([
	    		'policy' => $policy,
	    		'id' => $id
	    	]);
    	}

    	$delete = $request->getPost('delete', 'No');
    	if($delete == 'Yes'){
    		$id = (int) $policy->getId();
    		$this->table->deletePost($id);

    		return $this->redirect()->toRoute('home');
    	}else{
    		return $this->redirect()->toRoute('home');
    	}


    }
    	
}

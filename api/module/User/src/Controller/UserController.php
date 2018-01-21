<?php

namespace User\Controller;


use Controle\Controller\AbstractRestController;

class UserController extends AbstractRestController
{
    private function getVariaveis()
    {
		$this->form = $this->container->get('FormElementManager')->get('User\Form\UserForm');
        $this->route = 'user';
        $this->viewData = 'users';
        $this->pagination = true;
        $this->template = 'user/user/index.phtml';
        $this->div = '';
        $this->primaryKey = null;
        $this->order_by = 'id';
        $this->entity = '\User\Entity\User';
        $this->searchFrase = '';
        $this->searchDate = '';
    }
  
    
    public function indexAction()
    {
       // $this->getVariaveis();
        
        $this->div = $this->params('div');

        $divDados  = explode("_", $this->params('div'));
        
       //return parent::indexAction();
    }
}

<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel,
	Zend\View\Model\JsonModel
;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $viewModel = new ViewModel();

        return $viewModel;
    }

    //view helper ve layout çalışmaz
    public function indexJsonAction()
    {
    	$result = $this->getAlbumTable()->findAll();
    	$serialize = serialize($result);
        $jsonModel = new JsonModel();
        $jsonModel->setVariable('result', $serialize);
        //$jsonModel->setTerminal(false);
        return $jsonModel;
    }  

    public function indexWithoutRenderAction()
    {

        return '';
    }

    /**
     * @return \Application\Repository\AlbumRepository
     */
    public function getAlbumTable()
    {
        static $table;

        if (null === $table) {
            $table = $this->getServiceLocator()->get('albumTable');
        }
        return $table;
    }    
}

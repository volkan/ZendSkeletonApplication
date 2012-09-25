<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

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
    	$result = $this->getAlbumTable()->fetchAll();
    	$serialize = serialize($result);
        $jsonModel = new JsonModel();
        $jsonModel->setVariable('result', $serialize);

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

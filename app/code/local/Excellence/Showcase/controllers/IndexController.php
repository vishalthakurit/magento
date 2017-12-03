<?php
class Excellence_Showcase_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/showcase?id=15 
    	 *  or
    	 * http://site.com/showcase/id/15 	
    	 */
    	/* 
		$showcase_id = $this->getRequest()->getParam('id');

  		if($showcase_id != null && $showcase_id != '')	{
			$showcase = Mage::getModel('showcase/showcase')->load($showcase_id)->getData();
		} else {
			$showcase = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($showcase == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$showcaseTable = $resource->getTableName('showcase');
			
			$select = $read->select()
			   ->from($showcaseTable,array('showcase_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$showcase = $read->fetchRow($select);
		}
		Mage::register('showcase', $showcase);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}
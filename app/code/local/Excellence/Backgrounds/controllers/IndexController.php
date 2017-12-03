<?php
class Excellence_Backgrounds_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/backgrounds?id=15 
    	 *  or
    	 * http://site.com/backgrounds/id/15 	
    	 */
    	/* 
		$backgrounds_id = $this->getRequest()->getParam('id');

  		if($backgrounds_id != null && $backgrounds_id != '')	{
			$backgrounds = Mage::getModel('backgrounds/backgrounds')->load($backgrounds_id)->getData();
		} else {
			$backgrounds = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($backgrounds == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$backgroundsTable = $resource->getTableName('backgrounds');
			
			$select = $read->select()
			   ->from($backgroundsTable,array('backgrounds_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$backgrounds = $read->fetchRow($select);
		}
		Mage::register('backgrounds', $backgrounds);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}
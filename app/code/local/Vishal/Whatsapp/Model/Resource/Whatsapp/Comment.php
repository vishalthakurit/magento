<?php
/**
 * Vishal_Whatsapp extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Vishal
 * @package        Vishal_Whatsapp
 * @copyright      Copyright (c) 2018
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Whatsapp comments resource model
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author      Ultimate Module Creator
 */
class Vishal_Whatsapp_Model_Resource_Whatsapp_Comment extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * constructor
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function _construct()
    {
        $this->_init('vishal_whatsapp/whatsapp_comment', 'comment_id');
    }


    /**
     * Get store ids to which specified item is assigned
     *
     * @access public
     * @param int $whatsappId
     * @return array
     * @author Ultimate Module Creator
     */
    public function lookupStoreIds($commentId)
    {
        $adapter = $this->_getReadAdapter();
        $select  = $adapter->select()
            ->from($this->getTable('vishal_whatsapp/whatsapp_comment_store'), 'store_id')
            ->where('comment_id = ?', (int)$commentId);
        return $adapter->fetchCol($select);
    }

    /**
     * Perform operations after object load
     *
     * @access public
     * @param Mage_Core_Model_Abstract $object
     * @return Vishal_Whatsapp_Model_Resource_Whatsapp_Comment
     * @author Ultimate Module Creator
     */
    protected function _afterLoad(Mage_Core_Model_Abstract $object)
    {
        if ($object->getId()) {
            $stores = $this->lookupStoreIds($object->getId());
            $object->setData('store_id', $stores);
        }
        return parent::_afterLoad($object);
    }

    /**
     * Retrieve select object for load object data
     *
     * @param string $field
     * @param mixed $value
     * @param Vishal_Whatsapp_Model_Whatsapp_Comment $object
     * @return Zend_Db_Select
     */
    protected function _getLoadSelect($field, $value, $object)
    {
        $select = parent::_getLoadSelect($field, $value, $object);
        if ($object->getStoreId()) {
            $storeIds = array(Mage_Core_Model_App::ADMIN_STORE_ID, (int)$object->getStoreId());
            $select->join(
                array('whatsapp_whatsapp_comment_store' => $this->getTable('vishal_whatsapp/whatsapp_comment_store')),
                $this->getMainTable() . '.comment_id = whatsapp_whatsapp_comment_store.comment_id',
                array()
            )
            ->where('whatsapp_whatsapp_comment_store.store_id IN (?)', $storeIds)
            ->order('whatsapp_whatsapp_comment_store.store_id DESC')
            ->limit(1);
        }
        return $select;
    }

    /**
     * Assign whatsapp comments to store views
     *
     * @access protected
     * @param Mage_Core_Model_Abstract $object
     * @return Vishal_Whatsapp_Model_Resource_Whatsapp_Comment
     * @author Ultimate Module Creator
     */
    protected function _afterSave(Mage_Core_Model_Abstract $object)
    {
        $oldStores = $this->lookupStoreIds($object->getId());
        $newStores = (array)$object->getStores();
        if (empty($newStores)) {
            $newStores = (array)$object->getStoreId();
        }
        $table  = $this->getTable('vishal_whatsapp/whatsapp_comment_store');
        $insert = array_diff($newStores, $oldStores);
        $delete = array_diff($oldStores, $newStores);
        if ($delete) {
            $where = array(
                'comment_id = ?'  => (int) $object->getId(),
                'store_id IN (?)' => $delete
            );
            $this->_getWriteAdapter()->delete($table, $where);
        }
        if ($insert) {
            $data = array();
            foreach ($insert as $storeId) {
                $data[] = array(
                    'comment_id'  => (int) $object->getId(),
                    'store_id'    => (int) $storeId
                );
            }
            $this->_getWriteAdapter()->insertMultiple($table, $data);
        }
        return parent::_afterSave($object);
    }
}

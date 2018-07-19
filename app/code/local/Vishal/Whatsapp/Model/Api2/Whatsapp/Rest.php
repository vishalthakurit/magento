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
 * Whatsapp abstract REST API handler model
 *
 * @category    Vishal
 * @package     Vishal_Whatsapp
 * @author      Ultimate Module Creator
 */
abstract class Vishal_Whatsapp_Model_Api2_Whatsapp_Rest extends Vishal_Whatsapp_Model_Api2_Whatsapp
{
    /**
     * current whatsapp
     */
    protected $_whatsapp;

    /**
     * retrieve entity
     *
     * @access protected
     * @return array|mixed
     * @author Ultimate Module Creator
     */
    protected function _retrieve() {
        $whatsapp = $this->_getWhatsapp();
        $this->_prepareWhatsappForResponse($whatsapp);
        return $whatsapp->getData();
    }

    /**
     * get collection
     *
     * @access protected
     * @return array
     * @author Ultimate Module Creator
     */
    protected function _retrieveCollection() {
        $collection = Mage::getResourceModel('vishal_whatsapp/whatsapp_collection');
        $entityOnlyAttributes = $this->getEntityOnlyAttributes(
            $this->getUserType(),
            Mage_Api2_Model_Resource::OPERATION_ATTRIBUTE_READ
        );
        $availableAttributes = array_keys($this->getAvailableAttributes(
            $this->getUserType(),
            Mage_Api2_Model_Resource::OPERATION_ATTRIBUTE_READ)
        );
        $collection->addFieldToFilter('status', array('eq' => 1));
        $store = $this->_getStore();
        $collection->addStoreFilter($store->getId());
        $this->_applyCollectionModifiers($collection);
        $whatsapps = $collection->load();
        $whatsapps->walk('afterLoad');
        foreach ($whatsapps as $whatsapp) {
            $this->_setWhatsapp($whatsapp);
            $this->_prepareWhatsappForResponse($whatsapp);
        }
        $whatsappsArray = $whatsapps->toArray();
        $whatsappsArray = $whatsappsArray['items'];

        return $whatsappsArray;
    }

    /**
     * prepare whatsapp for response
     *
     * @access protected
     * @param Vishal_Whatsapp_Model_Whatsapp $whatsapp
     * @author Ultimate Module Creator
     */
    protected function _prepareWhatsappForResponse(Vishal_Whatsapp_Model_Whatsapp $whatsapp) {
        $whatsappData = $whatsapp->getData();
        if ($this->getActionType() == self::ACTION_TYPE_ENTITY) {
            $whatsappData['url'] = $whatsapp->getWhatsappUrl();
        }
    }

    /**
     * create whatsapp
     *
     * @access protected
     * @param array $data
     * @return string|void
     * @author Ultimate Module Creator
     */
    protected function _create(array $data) {
        $this->_critical(self::RESOURCE_METHOD_NOT_ALLOWED);
    }

    /**
     * update whatsapp
     *
     * @access protected
     * @param array $data
     * @author Ultimate Module Creator
     */
    protected function _update(array $data) {
        $this->_critical(self::RESOURCE_METHOD_NOT_ALLOWED);
    }

    /**
     * delete whatsapp
     *
     * @access protected
     * @author Ultimate Module Creator
     */
    protected function _delete() {
        $this->_critical(self::RESOURCE_METHOD_NOT_ALLOWED);
    }

    /**
     * delete current whatsapp
     *
     * @access protected
     * @param Vishal_Whatsapp_Model_Whatsapp $whatsapp
     * @author Ultimate Module Creator
     */
    protected function _setWhatsapp(Vishal_Whatsapp_Model_Whatsapp $whatsapp) {
        $this->_whatsapp = $whatsapp;
    }

    /**
     * get current whatsapp
     *
     * @access protected
     * @return Vishal_Whatsapp_Model_Whatsapp
     * @author Ultimate Module Creator
     */
    protected function _getWhatsapp() {
        if (is_null($this->_whatsapp)) {
            $whatsappId = $this->getRequest()->getParam('id');
            $whatsapp = Mage::getModel('vishal_whatsapp/whatsapp');
            $whatsapp->load($whatsappId);
            if (!($whatsapp->getId())) {
                $this->_critical(self::RESOURCE_NOT_FOUND);
            }
            if ($this->_getStore()->getId()) {
                $isValidStore = count(array_intersect(array(0, $this->_getStore()->getId()), $whatsapp->getStoreId()));
                if (!$isValidStore) {
                    $this->_critical(self::RESOURCE_NOT_FOUND);
                }
            }
            $this->_whatsapp = $whatsapp;
        }
        return $this->_whatsapp;
    }
}

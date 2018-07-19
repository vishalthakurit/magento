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
class Vishal_Whatsapp_Model_Whatsapp_Api extends Mage_Api_Model_Resource_Abstract
{


    /**
     * init whatsapp
     *
     * @access protected
     * @param $whatsappId
     * @return Vishal_Whatsapp_Model_Whatsapp
     * @author      Ultimate Module Creator
     */
    protected function _initWhatsapp($whatsappId)
    {
        $whatsapp = Mage::getModel('vishal_whatsapp/whatsapp')->load($whatsappId);
        if (!$whatsapp->getId()) {
            $this->_fault('whatsapp_not_exists');
        }
        return $whatsapp;
    }

    /**
     * get whatsapps
     *
     * @access public
     * @param mixed $filters
     * @return array
     * @author Ultimate Module Creator
     */
    public function items($filters = null)
    {
        $collection = Mage::getModel('vishal_whatsapp/whatsapp')->getCollection();
        $apiHelper = Mage::helper('api');
        $filters = $apiHelper->parseFilters($filters);
        try {
            foreach ($filters as $field => $value) {
                $collection->addFieldToFilter($field, $value);
            }
        } catch (Mage_Core_Exception $e) {
            $this->_fault('filters_invalid', $e->getMessage());
        }
        $result = array();
        foreach ($collection as $whatsapp) {
            $result[] = $this->_getApiData($whatsapp);
        }
        return $result;
    }

    /**
     * Add whatsapp
     *
     * @access public
     * @param array $data
     * @return array
     * @author Ultimate Module Creator
     */
    public function add($data)
    {
        try {
            if (is_null($data)) {
                throw new Exception(Mage::helper('vishal_whatsapp')->__("Data cannot be null"));
            }
            $data = (array)$data;
            $whatsapp = Mage::getModel('vishal_whatsapp/whatsapp')
                ->setData((array)$data)
                ->save();
        } catch (Mage_Core_Exception $e) {
            $this->_fault('data_invalid', $e->getMessage());
        } catch (Exception $e) {
            $this->_fault('data_invalid', $e->getMessage());
        }
        return $whatsapp->getId();
    }

    /**
     * Change existing whatsapp information
     *
     * @access public
     * @param int $whatsappId
     * @param array $data
     * @return bool
     * @author Ultimate Module Creator
     */
    public function update($whatsappId, $data)
    {
        $whatsapp = $this->_initWhatsapp($whatsappId);
        try {
            $data = (array)$data;
            $whatsapp->addData($data);
            $whatsapp->save();
        }
        catch (Mage_Core_Exception $e) {
            $this->_fault('save_error', $e->getMessage());
        }

        return true;
    }

    /**
     * remove whatsapp
     *
     * @access public
     * @param int $whatsappId
     * @return bool
     * @author Ultimate Module Creator
     */
    public function remove($whatsappId)
    {
        $whatsapp = $this->_initWhatsapp($whatsappId);
        try {
            $whatsapp->delete();
        } catch (Mage_Core_Exception $e) {
            $this->_fault('remove_error', $e->getMessage());
        }
        return true;
    }

    /**
     * get info
     *
     * @access public
     * @param int $whatsappId
     * @return array
     * @author Ultimate Module Creator
     */
    public function info($whatsappId)
    {
        $result = array();
        $whatsapp = $this->_initWhatsapp($whatsappId);
        $result = $this->_getApiData($whatsapp);
        return $result;
    }

    /**
     * get data for api
     *
     * @access protected
     * @param Vishal_Whatsapp_Model_Whatsapp $whatsapp
     * @return array()
     * @author Ultimate Module Creator
     */
    protected function _getApiData(Vishal_Whatsapp_Model_Whatsapp $whatsapp)
    {
        return $whatsapp->getData();
    }
}

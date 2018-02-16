<?php
/**
 * PH2M_Phcustomerlogin
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Phcustomerlogin
 * @copyright  Copyright (c) 2018 PH2M SARL
 * @author     PH2M SARL <contact@ph2m.com> : http://www.ph2m.com/
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class PH2M_PhCustomerLogin_Block_Adminhtml_Customer extends Mage_Core_Block_Template
{
    /**
     * Return all store active
     *
     * @return Mage_Core_Model_Resource_Store_Collection|Mage_Eav_Model_Entity_Collection_Abstract
     */
    public function getStoreList()
    {
        $stores = Mage::getResourceModel('core/store_collection')
            ->addFieldToFilter('store_id', array('neq' => Mage_Core_Model_App::ADMIN_STORE_ID))
            ->addFieldToFilter('is_active', 1)
            ;
        if(Mage::getStoreConfig('customer/account_share/scope')) {
            $stores->addFieldToFilter('store_id', $this->getCustomer()->getStore()->getId());
        }
        return $stores;
    }


    /**
     * Return true if default customer store = store in param
     *
     * @param $store
     * @return bool
     */
    public function isUserDefaultStore($store, $customer)
    {
        if($store->getId() == $customer->getStore()->getId()) {
            return true;
        }
        return false;
    }

    /**
     * Return admin controller url
     *
     * @return string
     */
    public function getSubmitUrl()
    {
        return Mage::helper('adminhtml')->getUrl('*/customerlogin/backOfficeLogin');
    }


    /**
     * Retrieve current customer
     *
     * @return bool|Mage_Customer_Model_Customer|mixed
     */
    public function getCustomer()
    {
        $customer = Mage::registry('current_customer');
        if($customer && $customer->getId()) {
            return $customer;
        } else {
            return false;
        }
    }
}
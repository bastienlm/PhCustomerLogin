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
 * @category   SwitchCustomerLogin
 * @copyright  Copyright (c) 2018 PH2M SARL
 * @author     PH2M SARL <contact@ph2m.com> : http://www.ph2m.com/
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class PH2M_PhCustomerLogin_Adminhtml_CustomerloginController extends Mage_Adminhtml_Controller_Action
{

    /**
     * Login customer in front with specific store
     *
     * @return Mage_Adminhtml_Controller_Action|Mage_Core_Controller_Varien_Action
     */
    public function backOfficeLoginAction()
    {

        $customerId     = (int) $this->getRequest()->getParam('customer_id');
        $storeToLogin   = (int) $this->getRequest()->getParam('login_store_id');
        $loginAction    = (string) $this->getRequest()->getParam('login_action');

        if ($customerId && $storeToLogin) {

            // Generate a random auth token
            $tokenString    = md5(rand(0, 5000));

            $customer = Mage::getModel('customer/customer')
                ->load($customerId)
            ;

            // Set Token
            $customer
                ->setLoginAdminToken($tokenString)
                ->save();


            Mage::app()->setCurrentStore($storeToLogin);

            $url = Mage::helper('phcustomerlogin')->getFrontLoginUrl($tokenString, $customerId, $storeToLogin, $loginAction);

            return $this->_redirectUrl($url);
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('phcustomerlogin')->__('Invalid form params'));

        return $this->_redirectReferer();


    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/customer/phcustomerlogin');
    }


}

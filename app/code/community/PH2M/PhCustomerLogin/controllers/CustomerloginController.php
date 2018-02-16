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

class PH2M_PhCustomerLogin_CustomerloginController extends Mage_Core_Controller_Front_Action
{


    /**
     * Login customer if token is correct
     *
     *
     * @return Mage_Core_Controller_Varien_Action|void
     */
    public function loginAction()
    {

        $tokenString    = $this->getRequest()->getParam('token');
        $customerId     = $this->getRequest()->getParam('id');
        $loginAction    = $this->getRequest()->getParam('action');

        if ($tokenString !== false && $customerId !== false) {

            $customer = Mage::getModel('customer/customer')->load($customerId);

            if ($customer->getId() && $customer->getLoginAdminToken() == $tokenString) {

                Mage::getSingleton('customer/session')->setCustomerAsLoggedIn($customer);

                $customer->unsetData('login_admin_token');

                // Set session for order
                Mage::getSingleton('core/session')->setIsAdminLogin(true);
                Mage::getSingleton('core/session')->setAdminLoginOrigin($loginAction);

            }
        }

        $this->_redirect('customer/account');
    }
}
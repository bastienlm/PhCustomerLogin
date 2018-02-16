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

class PH2M_PhCustomerLogin_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Return frontend url with customer and token params
     *
     * @param $token
     * @param $user
     * @param $store
     * @return string
     */
    public function getFrontLoginUrl($token, $user, $store, $loginAction)
    {
        $baseUrl = Mage::app()->getStore($store)->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
        return $baseUrl . 'phcustomerlogin/customerlogin/login?token=' .
            $token .
            '&id=' .
            $user .
            '&action=' .
            $loginAction
            ;

    }

}
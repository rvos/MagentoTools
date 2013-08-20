<?php
include_once dirname(__FILE__) . '/../../../../../Mage.php';

Mage::setIsDeveloperMode(TRUE);
ini_set('display_errors', TRUE);

Mage::app('admin')->setCurrentStore(0);

Mage::app()->getLocale()->setLocale(Mage::app()->getLocale()->getDefaultLocale());
Mage::app()->getTranslator()->init('global', TRUE);
Mage::app()->getTranslator()->init('adminhtml', TRUE);

class deleteCustomerAddresses {

    public function run() {

        echo "RUNNING THIS SCRIPT WILL RESULT IN THE DELETION OF ALL CUSTOMERS ADDRESS DATA\n\n";
        echo ">>> YOU HAVE 10 SECONDS TO CANCEL <<<\n\n";
        
        sleep(10);

        $customers = Mage::getModel("customer/customer")->getCollection();

        foreach ($customers as $customer) {

            $customerAddressCollection = Mage::getResourceModel('customer/address_collection')->addAttributeToFilter('parent_id',$customer->getId())->getItems();

            $ca=0;
            foreach($customerAddressCollection as $customerAddress){
                $customer_address_id = $customerAddress->getData('entity_id');

                if($customer_address_id!=""){   
                    Mage::getModel('customer/address')->load($customer_address_id)->delete();
                }
                
                $ca++;
            }
        }

        echo "Deleted $ca addresses\n\n";
        echo "FINISHED DELETING ALL CUSTOMER ADDRESSES\n";
    } 

}

$delete = new deleteCustomerAddresses(); 
$delete->run();

<?php
include_once dirname(__FILE__) . '/../../../../../Mage.php';

Mage::setIsDeveloperMode(TRUE);
ini_set('display_errors', TRUE);

Mage::app('admin')->setCurrentStore(0);

Mage::app()->getLocale()->setLocale(Mage::app()->getLocale()->getDefaultLocale());
Mage::app()->getTranslator()->init('global', TRUE);
Mage::app()->getTranslator()->init('adminhtml', TRUE);

class deleteCategories {

    public function run() {

        echo "RUNNING THIS SCRIPT WILL RESULT IN THE DELETION OF ALL CATEGORIES\n\n";
        echo ">>> YOU HAVE 10 SECONDS TO CANCEL <<<\n\n";
        
        sleep(10);

        $categories = Mage::getModel('catalog/category')->getCollection()->addAttributeToSelect('*');
        
        $ct=0;
        foreach ($categories as $id=>$category) {
            if($id<=5){
                echo "Preserving root category\n";
            } else {
                try {
                    $category->delete();
                    $ct++;
                } catch (Exception $e){
                    echo "Skipping non-removable category\n";
                }
            }
        }

        echo "\nDeleted $ct categories\n\n";
        echo "FINISHED DELETED ALL CATEGORIES\n";
    }         
}

$delete = new deleteCategories(); 
$delete->run();

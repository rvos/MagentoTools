<?php
include_once dirname(__FILE__) . '/../../../../../Mage.php';

Mage::setIsDeveloperMode(TRUE);
ini_set('display_errors', TRUE);

Mage::app('admin')->setCurrentStore(0);

Mage::app()->getLocale()->setLocale(Mage::app()->getLocale()->getDefaultLocale());
Mage::app()->getTranslator()->init('global', TRUE);
Mage::app()->getTranslator()->init('adminhtml', TRUE);

class deleteAttributes {

    public function run() {

        echo "RUNNING THIS SCRIPT WILL RESULT IN THE DELETION OF ALL ATTRIBUTE SETS AND ATTRIBUTES\n\n";
        echo ">>> YOU HAVE 10 SECONDS TO CANCEL <<<\n\n";
        
        sleep(10);

        $attributeSetCollection = Mage::getResourceModel('eav/entity_attribute_set_collection') ->load();
        $attributeCollection = Mage::getResourceModel('eav/entity_attribute_collection') ->load();
        
        $as=0;
        foreach ($attributeSetCollection as $id=>$attributeSet) {
            $attributeSet->delete();
              $at++;
        }
        
        echo "Deleted $as attribute sets \n";

        $at=0;
        foreach($attributeCollection as $id=>$attribute){
              $attribute->delete($id);
              $at++;
         }

        echo "Deleted $at attributes\n\n";
        echo "FINISHED DELETED ALL ATTRIBUTES AND ATTRIBUTE SETS\n";
    }         
}

$delete = new deleteAttributes(); 
$delete->run();

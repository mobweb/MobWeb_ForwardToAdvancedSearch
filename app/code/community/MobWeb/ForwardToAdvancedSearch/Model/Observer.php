<?php

class MobWeb_ForwardToAdvancedSearch_Model_Observer
{
    public function controllerActionPostdispatchCatalogsearchResultIndex($observer)
    {
        $result = Mage::app()->getLayout()->getBlock('search_result_list');
        $products = $result->getLoadedProductCollection();

        if(0 === (int) $products->getSize()) {
            // Generate a notice to be displayed on the next page load
            Mage::getSingleton('core/session')->addError(Mage::helper('forwardtoadvancedsearch')->__('Your search returns no results. Please try again using our advanced search.'));

            // Forward to the Advanced Search index
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('catalogsearch/advanced'));
        }
    }
}
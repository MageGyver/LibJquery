<?php

/**
 * .
 */
class MageGyver_LibJquery_Model_Adminhtml_System_Config_Source_Yesnotindev extends Mage_Adminhtml_Model_System_Config_Source_Yesno
{
    /**
     * [toOptionArray description]
     * @return [type] [description]
     */
    public function toOptionArray()
    {
        $data = parent::toOptionArray();
        $data[] = array(
            'value'     => MageGyver_LibJquery_Helper_Data::JQ_MINIFY_YESNOTINDEV,
            'label'     => Mage::helper('libjquery')->__('Yes, but not in DEV mode'),
        );

        return $data;
    }



    /**
     * [toArray description]
     * @return [type] [description]
     */
    public function toArray()
    {
        $data = parent::toArray();
        $data[2] = Mage::helper('libjquery')->__('Not in DEV mode');

        return $data;
    }
}

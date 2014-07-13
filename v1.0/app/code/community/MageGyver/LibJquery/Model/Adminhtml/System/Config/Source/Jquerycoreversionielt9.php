<?php

/**
 * .
 */
class MageGyver_LibJquery_Model_Adminhtml_System_Config_Source_Jquerycoreversionielt9
{
    /**
     * [toOptionArray description]
     * @return [type] [description]
     */
    public function toOptionArray()
    {
        $data = array();
        $data[] = array(
            'value'     => 0,
            'label'     => Mage::helper('libjquery')->__('No'),
        );
        $data[] = array(
            'value'     => MageGyver_LibJquery_Helper_Data::JQ_VERSION_LATEST_OLDIE,
            'label'     => Mage::helper('libjquery')->__('Latest'),
        );

        $versions = array_reverse(Mage::helper('libjquery')->getCoreVersions(true));
        foreach ($versions as $version => $files) {
            $data[] = array(
                'value'     => $version,
                'label'     => $version,
            );
        }

        return $data;
    }
}

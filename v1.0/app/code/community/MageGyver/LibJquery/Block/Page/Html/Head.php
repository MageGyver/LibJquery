<?php

/**
* .
*/
class MageGyver_LibJquery_Block_Page_Html_Head extends Mage_Page_Block_Html_Head
{
    /**
     * [addItem description]
     * @param [type]  $type   [description]
     * @param [type]  $name   [description]
     * @param [type]  $params [description]
     * @param [type]  $if     [description]
     * @param [type]  $cond   [description]
     * @param boolean $first  [description]
     */
    public function addItem($type, $name, $params=null, $if=null, $cond=null, $first = null)
    {
        if ($type==='skin_css' && empty($params)) {
            $params = 'media="all"';
        }
        if (!(string)$cond) {
            $cond = null;
        }
        $this->_data['items'][$type.'/'.$name] = array(
            'type'   => $type,
            'name'   => $name,
            'params' => $params,
            'if'     => $if,
            'cond'   => $cond,
            'first'  => $first,
       );

        return $this;
    }



    /**
     * [getCssJsHtml description]
     * @return [type] [description]
     * @see Mage_Page_Block_Html_Head::getCssJsHtml()
     */
    public function getCssJsHtml()
    {
        // separate items by types
        $lines  = array();
        foreach ($this->_data['items'] as $item) {
            if (!is_null($item['cond']) && !$this->getData($item['cond']) || !isset($item['name'])) {
                continue;
            }
            $if     = !empty($item['if']) ? $item['if'] : '';
            $params = !empty($item['params']) ? $item['params'] : '';
            switch ($item['type']) {
                case 'js':        // js/*.js
                case 'skin_js':   // skin/*/*.js
                case 'js_css':    // js/*.css
                case 'skin_css':  // skin/*/*.css
                    $lines[$first][$if][$item['type']][$params][$item['name']] = $item['name'];
                    break;
                default:
                    $this->_separateOtherHtmlHeadElements($lines, $if, $item['type'], $params, $item['name'], $item);
                    break;
            }
        }

        uksort($lines, function($a, $b) {
            if ($a == $b) {
                return 0;
            }
            if ('' == $a) {
                return 1;
            }
            if ('' == $b) {
                return -1;
            }
            return $a < $b ? -1 : 1;
        });

        // prepare HTML
        $shouldMergeJs = Mage::getStoreConfigFlag('dev/js/merge_files');
        $shouldMergeCss = Mage::getStoreConfigFlag('dev/css/merge_css_files');
        $html   = '';
        foreach ($lines as $first => $_lines) {
            foreach ($_lines as $if => $items) {
                if (empty($items)) {
                    continue;
                }
                if (!empty($if)) {
                    if ('!IE' == $if) {
                        $html .= '<![if !IE]>'."\n";
                    } else {
                        $html .= '<!--[if '.$if.']>'."\n";
                    }
                }

                // static and skin css
                $html .= $this->_prepareStaticAndSkinElements('<link rel="stylesheet" type="text/css" href="%s"%s />' . "\n",
                    empty($items['js_css']) ? array() : $items['js_css'],
                    empty($items['skin_css']) ? array() : $items['skin_css'],
                    $shouldMergeCss ? array(Mage::getDesign(), 'getMergedCssUrl') : null
                );

                // static and skin javascripts
                $html .= $this->_prepareStaticAndSkinElements('<script type="text/javascript" src="%s"%s></script>' . "\n",
                    empty($items['js']) ? array() : $items['js'],
                    empty($items['skin_js']) ? array() : $items['skin_js'],
                    $shouldMergeJs ? array(Mage::getDesign(), 'getMergedJsUrl') : null
                );

                // other stuff
                if (!empty($items['other'])) {
                    $html .= $this->_prepareOtherHtmlHeadElements($items['other']) . "\n";
                }

                if (!empty($if)) {
                    if ('!IE' == $if) {
                        $html .= '<![endif]>'."\n";
                    } else {
                        $html .= '<![endif]-->'."\n";
                    }
                }
            }
        }
        return $html;
    }
}

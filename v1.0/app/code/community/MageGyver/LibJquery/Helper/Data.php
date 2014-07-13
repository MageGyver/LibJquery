<?php

/**
* .
*/
class MageGyver_LibJquery_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     *
     */
    const
        XMLPATH_CORE_VERSIONS               = 'jquery/core/versions',
        XMLPATH_MIGRATE_VERSIONS            = 'jquery/migrate/versions',
        XMLPATH_NOCONFLICT_FILE             = 'jquery/noconflict',
        XMLPATH_INCLUDE_PATH                = 'jquery/include_path',
        XMLPATH_LOGFILE                     = 'jquery/logfile',
        XMLPATH_CONDITION_OLD_IE            = 'jquery/old_ie_condition',
        XMLPATH_CONDITION_NEW_IE            = 'jquery/new_ie_condition',

        XMLPATH_JQUERY_CORE                 = 'dev/jquery/jquery_core',
        XMLPATH_JQUERY_CORE_OLDIE           = 'dev/jquery/jquery_core_oldie',
        XMLPATH_USE_NOCONFLICT              = 'dev/jquery/use_noconflict',
        XMLPATH_USE_MINIFIED                = 'dev/jquery/use_minified',
        XMLPATH_JQUERY_MIGRATE              = 'dev/jquery/jquery_migrate';



    /**
     *
     */
    const
        JQ_VERSION_LATEST                   = 'latest',
        JQ_VERSION_LATEST_OLDIE             = 'latest_oldie';



    /**
     *
     */
    const
        JQ_MINIFY_NO                        = 0,
        JQ_MINIFY_YES                       = 1,
        JQ_MINIFY_YESNOTINDEV               = 2;



    /**
     * [getLatestVersionValue description]
     * @return [type] [description]
     */
    public function getLatestVersionValue()
    {
        return self::JQ_VERSION_LATEST;
    }



    /**
     * [getLatestOldIEVersionValue description]
     * @return [type] [description]
     */
    public function getLatestOldIEVersionValue()
    {
        return self::JQ_VERSION_LATEST_OLDIE;
    }



    /**
     * [getConfigValue description]
     * @param  [type]  $path        [description]
     * @param  [type]  $store       [description]
     * @param  boolean $emptyIsNull [description]
     * @return [type]               [description]
     */
    protected function getConfigValue($path, $store = null, $emptyIsNull = true)
    {
        $value = Mage::getStoreConfig($path, $store);
        return '' === trim($value) && $emptyIsNull ? null : $value;
    }



    /**
     * [log description]
     * @param  [type] $msg   [description]
     * @param  [type] $level [description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function log($msg, $level = null, $store = null)
    {
        $logfile = $this->getConfigValue(self::XMLPATH_LOGFILE, $store);
        if (!$logfile) {
            $logfile = 'MageGyver_LibJquery.log';
        }
        Mage::log($msg, $level, $logfile);
    }



    /**
     * [getCoreVersions description]
     * @param  boolean $onlyIElt9 [description]
     * @param  [type]  $store     [description]
     * @return [type]             [description]
     */
    public function getCoreVersions($onlyIElt9 = false, $store = null)
    {
        $versions = json_decode($this->getConfigValue(self::XMLPATH_CORE_VERSIONS, $store), true);

        if (!$onlyIElt9) {
            return $versions;
        }

        return array_filter($versions, function($a) {
            return $a['oldIE'];
        });
    }



    /**
     * [getMigrateVersions description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getMigrateVersions($store = null)
    {
        return json_decode($this->getConfigValue(self::XMLPATH_MIGRATE_VERSIONS, $store), true);
    }



    /**
     * [getIncludePath description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getIncludePath($store = null)
    {
        return $this->getConfigValue(self::XMLPATH_INCLUDE_PATH, $store);
    }



    /**
     * [getNoconflictFilePath description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getNoconflictFilePath($store = null)
    {
        return $this->getConfigValue(self::XMLPATH_NOCONFLICT_FILE, $store);
    }



    /**
     * [getCurrentCoreVersion description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getCurrentCoreVersion($store = null)
    {
        return $this->getConfigValue(self::XMLPATH_JQUERY_CORE, $store);
    }



    /**
     * [getCurrentCoreOldIEVersion description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getCurrentCoreOldIEVersion($store = null)
    {
        return $this->getConfigValue(self::XMLPATH_JQUERY_CORE_OLDIE, $store);
    }



    /**
     * [getUseNoconflict description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getUseNoconflict($store = null)
    {
        return $this->getConfigValue(self::XMLPATH_USE_NOCONFLICT, $store);
    }



    /**
     * [getUseMinified description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getUseMinified($store = null)
    {
        return $this->getConfigValue(self::XMLPATH_USE_MINIFIED, $store);
    }



    /**
     * [getCurrentMigrateVersion description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getCurrentMigrateVersion($store = null)
    {
        return $this->getConfigValue(self::XMLPATH_JQUERY_MIGRATE, $store);
    }



    /**
     * [getOldIeCondition description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getOldIeCondition($store = null)
    {
        return $this->getConfigValue(self::XMLPATH_CONDITION_OLD_IE, $store);
    }



    /**
     * [getNonIeCondition description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getNonIeCondition($store = null)
    {
        return '!IE';
    }



    /**
     * [getNewIeCondition description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getNewIeCondition($store = null)
    {
        return $this->getConfigValue(self::XMLPATH_CONDITION_NEW_IE, $store);
    }



    /**
     * [getCoreVersionData description]
     * @param  [type]  $version        [description]
     * @param  boolean $disallowLatest [description]
     * @param  [type]  $store          [description]
     * @return [type]                  [description]
     */
    public function getCoreVersionData($version, $disallowLatest = false, $store = null)
    {
        $versionData = false;

        if (!$disallowLatest && self::JQ_VERSION_LATEST == $version) {
            $versions = $this->getCoreVersions(false, $store);
            $versionData = end($versions);
        } elseif (self::JQ_VERSION_LATEST_OLDIE == $version) {
            $versions = $this->getCoreVersions(true, $store);
            $versionData = end($versions);
        } else {
            $versions = $this->getCoreVersions(false, $store);
        }

        if (!$versionData && array_key_exists($version, $versions)) {
            $versionData = $versions[$version];
        }

        return $versionData;
    }



    /**
     * [getCurrentCoreVersionData description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getCurrentCoreVersionData($store = null)
    {
        if ($version = $this->getCurrentCoreVersion($store)) {
            return $this->getCoreVersionData($version);
        }
        return false;
    }



    /**
     * [getCurrentCoreOldIEVersionData description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getCurrentCoreOldIEVersionData($store = null)
    {
        if ($version = $this->getCurrentCoreOldIEVersion($store)) {
            return $this->getCoreVersionData($version, true);
        }
        return false;
    }



    /**
     * [getMigrateVersionData description]
     * @param  [type] $version [description]
     * @param  [type] $store   [description]
     * @return [type]          [description]
     */
    public function getMigrateVersionData($version, $store = null)
    {
        $versionData = false;
        $versions = $this->getMigrateVersions($store);

        if (self::JQ_VERSION_LATEST == $version) {
            $versionData = end($versions);
        }

        if (!$versionData && array_key_exists($version, $versions)) {
            $versionData = $versions[$version];
        }

        return $versionData;
    }



    /**
     * [getCurrentMigrateVersionData description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getCurrentMigrateVersionData($store = null)
    {
        if ($version = $this->getCurrentMigrateVersion($store)) {
            return $this->getMigrateVersionData($version);
        }
        return false;
    }



    /**
     * [getCurrentCoreFile description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getCurrentCoreFile($store = null)
    {
        $file = false;
        if ($versionData = $this->getCurrentCoreVersionData($store)) {
            if ($this->getUseMinified($store)) {
                $file = $versionData['std'];
                if ($versionData['min']) {
                    $file = $versionData['min'];
                } else {
                    $this->log(sprintf('No minified file for jQuery core version "%s" available, using uncompressed file "%s" instead', $this->getCurrentCoreVersion($store), $file), Zend_Log::NOTICE);
                }
                if (self::JQ_MINIFY_YESNOTINDEV == $this->getUseMinified($store) && Mage::getIsDeveloperMode()) {
                    $file = $versionData['std'];
                    $this->log(sprintf('System DEVMODE active - Ignoring minified file for jQuery core version "%s", using uncompressed file "%s" instead', $this->getCurrentCoreVersion($store), $file), Zend_Log::NOTICE);
                }
            } else {
                $file = $versionData['std'];
            }
        } elseif ($version = $this->getCurrentCoreVersion($store)) {
            $this->log(sprintf('jQuery core version "%s" is not supported yet', $version), Zend_Log::WARN);
        }

        if ($file) {
            $relPath = 'js' . DS . $this->getIncludePath($store) . DS . $file;
            $path = Mage::getBaseDir() . DS . $relPath;
            if (!is_readable($path)) {
                $this->log(sprintf('Could not find jQuery core file "%s" for selected version "%s"', $relPath, $this->getCurrentCoreVersion($store)), Zend_Log::WARN);
                return;
            }
            return $this->getIncludePath($store) . '/' . $file;
        }
    }



    /**
     * [getCurrentCoreCondition description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getCurrentCoreCondition($store = null)
    {
        if (($versionData = $this->getCurrentCoreVersionData($store)) && ($versionDataOldIE = $this->getCurrentCoreOldIEVersionData($store))) {
            if (!$versionData['oldIE']) {
                return $this->getNewIeCondition($store);
            }
        }
    }



    /**
     * [getCurrentCoreOldIEFile description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getCurrentCoreOldIEFile($store = null)
    {
        $file = false;
        if ($versionData = $this->getCurrentCoreVersionData($store)) {
            if ($versionDataOldIE = $this->getCurrentCoreOldIEVersionData($store)) {
                if ($this->getUseMinified($store)) {
                    $file = $versionDataOldIE['std'];
                    if ($versionDataOldIE['min']) {
                        $file = $versionDataOldIE['min'];
                    } else {
                        $this->log(sprintf('(old IE) No minified file for jQuery core version "%s" available, using uncompressed file "%s" instead', $this->getCurrentCoreVersion($store), $file), Zend_Log::NOTICE);
                    }
                    if (self::JQ_MINIFY_YESNOTINDEV == $this->getUseMinified($store) && Mage::getIsDeveloperMode()) {
                        $file = $versionData['std'];
                        $this->log(sprintf('(old IE) System DEVMODE active - Ignoring minified file for jQuery core version "%s", using uncompressed file "%s" instead', $this->getCurrentCoreVersion($store), $file), Zend_Log::NOTICE);
                    }
                } else {
                    $file = $versionDataOldIE['std'];
                }
            } elseif ($versionOldIE = $this->getCurrentCoreOldIEVersion($store)) {
                $this->log(sprintf('(old IE) jQuery core version "%s" is not supported yet', $versionOldIE), Zend_Log::WARN);
            }
        }

        if ($file) {
            $relPath = 'js' . DS . $this->getIncludePath($store) . DS . $file;
            $path = Mage::getBaseDir() . DS . $relPath;
            if (!is_readable($path)) {
                $this->log(sprintf('(old IE) Could not find jQuery core file "%s" for selected version "%s"', $relPath, $this->getCurrentCoreOldIEVersion($store)), Zend_Log::WARN);
                return;
            }
            return $this->getIncludePath($store) . '/' . $file;
        }
    }



    /**
     * [getCurrentCoreNonIEFile description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getCurrentCoreNonIEFile($store = null)
    {
        $file = false;
        if ($versionData = $this->getCurrentCoreVersionData($store)) {
            if ($versionDataOldIE = $this->getCurrentCoreOldIEVersionData($store)) {
                if ($file = $this->getCurrentCoreFile($store)) {
                    return $file . '?nonie';
                }
            }
        }
    }



    /**
     * [getCurrentCoreOldIECondition description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getCurrentCoreOldIECondition($store = null)
    {
        if (($versionData = $this->getCurrentCoreVersionData($store)) && ($versionDataOldIE = $this->getCurrentCoreOldIEVersionData($store))) {
            if (!$versionData['oldIE']) {
                return $this->getOldIeCondition($store);
            }
        }
    }



    /**
     * [getCurrentCoreNonIECondition description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getCurrentCoreNonIECondition($store = null)
    {
        if (($versionData = $this->getCurrentCoreVersionData($store)) && ($versionDataOldIE = $this->getCurrentCoreOldIEVersionData($store))) {
            if (!$versionData['oldIE']) {
                return $this->getNonIeCondition($store);
            }
        }
    }



    /**
     * [getNoconflictFile description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getNoconflictFile($store = null)
    {
        if (($versionData = $this->getCurrentCoreVersionData($store)) && $this->getUseNoconflict($store)) {
            return $this->getIncludePath($store) . '/' . $this->getNoconflictFilePath($store);
        }
    }



    /**
     * [getNoconflictOldIEFile description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getNoconflictOldIEFile($store = null)
    {
        if (($versionData = $this->getCurrentCoreVersionData($store)) && ($versionDataOldIE = $this->getCurrentCoreOldIEVersionData($store))) {
            if (!$versionData['oldIE']) {
                if ($file = $this->getNoconflictFile($store)) {
                    return $file . '?oldie';
                }
            }
        }
    }



    /**
     * [getNoconflictNonIEFile description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getNoconflictNonIEFile($store = null)
    {
        if (($versionData = $this->getCurrentCoreVersionData($store)) && ($versionDataOldIE = $this->getCurrentCoreOldIEVersionData($store))) {
            if (!$versionData['oldIE']) {
                if ($file = $this->getNoconflictFile($store)) {
                    return $file . '?nonie';
                }
            }
        }
    }



    /**
     * [getCurrentMigrateFile description]
     * @param  boolean $useOldIe [description]
     * @param  [type]  $store    [description]
     * @return [type]            [description]
     */
    public function getCurrentMigrateFile($useOldIe = false, $store = null)
    {
        if (!$useOldIe) {
            $version = $this->getCurrentCoreVersion($store);
            $versionData = $this->getCurrentCoreVersionData($store);
        } else {
            $version = $this->getCurrentCoreOldIEVersion($store);
            $versionData = $this->getCurrentCoreOldIEVersionData($store);
        }

        if (!$versionData) {
            $this->log(sprintf('%sNo valid jQuery core version found for "%s", no jQuery migrate version will be added', $useOldIe ? '(old IE) ' : '', $version), Zend_Log::NOTICE);
            return;
        }

        if (!$versionData['canmig']) {
            $this->log(sprintf('%sCurrent jQuery core version "%s" doesn\'t need the migration tool, no jQuery migrate version will be added', $useOldIe ? '(old IE) ' : '', $version), Zend_Log::NOTICE);
            return;
        }

        $file = false;
        if ($versionData = $this->getCurrentMigrateVersionData($store)) {
            if ($this->getUseMinified($store)) {
                $file = $versionData['std'];
                if ($versionData['min']) {
                    $file = $versionData['min'];
                } else {
                    $this->log(sprintf('%sNo minified file for jQuery migrate version "%s" available, using uncompressed file "%s" instead', $useOldIe ? '(old IE) ' : '', $this->getCurrentMigrateVersion($store), $file), Zend_Log::NOTICE);
                }
            } else {
                $file = $versionData['std'];
            }
        } elseif ($version = $this->getCurrentMigrateVersion($store)) {
            $this->log(sprintf('%sjQuery migrate version "%s" is not supported yet', $useOldIe ? '(old IE) ' : '', $version), Zend_Log::WARN);
        }

        if ($file) {
            $relPath = 'js' . DS . $this->getIncludePath($store) . DS . $file;
            $path = Mage::getBaseDir() . DS . $relPath;
            if (!is_readable($path)) {
                $this->log(sprintf('%sCould not find jQuery migrate file "%s" for selected version "%s"', $useOldIe ? '(old IE) ' : '', $relPath, $this->getCurrentMigrateVersion($store)), Zend_Log::WARN);
                return;
            }
            return $this->getIncludePath($store) . '/' . $file;
        }
    }



    /**
     * [getCurrentMigrateOldIEFile description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getCurrentMigrateOldIEFile($store = null)
    {
        if (($versionData = $this->getCurrentCoreVersionData($store)) && ($versionDataOldIE = $this->getCurrentCoreOldIEVersionData($store))) {
            if (!$versionData['oldIE']) {
                if ($file = $this->getCurrentMigrateFile(true, $store)) {
                    return  $file . '?oldie';
                }
            }
        }
    }



    /**
     * [getCurrentMigrateNonIEFile description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    public function getCurrentMigrateNonIEFile($store = null)
    {
        if (($versionData = $this->getCurrentCoreVersionData($store)) && ($versionDataOldIE = $this->getCurrentCoreOldIEVersionData($store))) {
            if (!$versionData['oldIE']) {
                if ($file = $this->getCurrentMigrateFile(true, $store)) {
                    return  $file . '?nonie';
                }
            }
        }
    }
}

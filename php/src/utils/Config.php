<?php
namespace utils;

/**
 * Class: Config
 * Loads the config xml and presents it as an SimpleXmlElement
 *
 */
class Config {
    /**
     * CONFIG_PATH
     * The path to the config xml
     */
    const CONFIG_PATH = __DIR__ . "../../../../config/config.xml";

    private static $xmlConfig;

    /**
     * getXml
     * returns the SimpleXmlElement from the config.xml
     * The returned SimpleXmlElement is lazy evaluated and only instanced on the first call
     * to this function. All proceeding calls return the same object
     */
    static function getXml() : \SimpleXmlElement {
        if(self::$xmlConfig == null)
            self::$xmlConfig = new \SimpleXmlElement(file_get_contents(Config::CONFIG_PATH));
        return self::$xmlConfig;
    }
}

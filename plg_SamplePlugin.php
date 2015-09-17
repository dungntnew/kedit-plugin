<?php

class plg_SamplePlugin extends SC_Plugin_Base {

    /**
     * Constructor
     */
    public function __construct(array $arrSelfInfo) {
        parent::__construct($arrSelfInfo);
    }

    /**
     * Install
     * Executed when plug-in is installed.
     * Information is automatically written to the table dtb_plugin.
     *
     * @param array $arrPlugin plugin_info - from the dtb_plugin
     * @return void
     */
    function install($arrPlugin) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $objQuery->query("CREATE TABLE plg_sampleplugin (id INT,sampletext VARCHAR(255),update_date TIMESTAMP)");
        $arrModule = array();
        $arrModule['id'] = 1;
        $arrModule['sampletext'] = "Test";
        $arrModule['update_date'] = 'CURRENT_TIMESTAMP';
        $objQuery->insert('plg_sampleplugin', $arrModule);
        copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/logo.png", PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/logo.png");
    }

    /**
     * Uninstall
     * 
     * Executed when plug-in is uninstalled.
     * @param array $arrPlugin 
     * @return void
     */
    function uninstall($arrPlugin) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $objQuery->query("DROP TABLE plg_sampleplugin");
        unlink(PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/logo.png");
    }

    /**
     * Enable plug-in
     * 
     * When enabled, the plug-in will start.
     *    
     * @param array $arrPlugin
     * @return void
     */
    function enable($arrPlugin) {
        // nop
    }

    /**
     * Disable  plug-in
     * 
     * When disabled, the plug-in will turn off.
     *    
     * @param array $arrPlugin
     * @return void
     */
    function disable($arrPlugin) {
        // nop
    }

    /**
     * PrefilterTransform hookpoint
     * 
     * Modifies the template
     *
     * @param string &$source Template html source
     * @param LC_Page_Ex $objPage Page object
     * @param string $filename Template filename
     * @return void
     */
    function prefilterTransform(&$source, LC_Page_Ex $objPage, $filename) {
        // SC_Helper_Transform
        $objTransform = new SC_Helper_Transform($source);
        switch ($objPage->arrPageLayout['device_type_id']) {
            case DEVICE_TYPE_MOBILE:
            case DEVICE_TYPE_SMARTPHONE:
                break;
            case DEVICE_TYPE_PC: // PC  
                if (strpos($filename, 'products/detail.tpl') !== false) {
                    $template_dir = PLUGIN_UPLOAD_REALDIR . $this->arrSelfInfo['plugin_code'] . '/templates/';
                    $objTransform->select('.normal_price')->insertBefore(file_get_contents($template_dir . 'sample_plugin_add.tpl'));
                }
                break;
            case DEVICE_TYPE_ADMIN:
                break;
            default:
                break;
        }

        $source = $objTransform->getHTML();
    }

    /**
     * LC_Page_Products_Detail_action_after hookpoint
     * 
     * Modifies the template
     * @param LC_Page_Ex $objPage Page object
     * 
     */
    function dataafter($objPage) {
        $objPage->arrForm['sampletext'] = $this->getdata();
    }

    /**
     * Select sampletext from table.
     * 
     * @return data 
     * 
     */
    function getdata() {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $sql = "SELECT sampletext FROM plg_sampleplugin";
        $data = $objQuery->getOne($sql);
        return $data;
    }
}

?>

<?php

require_once CLASS_EX_REALDIR . 'page_extends/admin/LC_Page_Admin_Ex.php';

class LC_Page_Plugin_SamplePluginConfig extends LC_Page_Admin_Ex {

    var $arrForm = array();

    /**
     * Initialize.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = PLUGIN_UPLOAD_REALDIR . "SamplePlugin/templates/config.tpl";
        $this->tpl_subtitle = "Sample Plug-in config";
    }

    /**
     * Process.
     *
     * @return void
     */
    function process() {
        $this->action();
        $this->sendResponse();
    }

    /**
     * Page action
     *
     * @return void
     */
    function action() {
        $objFormParam = new SC_FormParam_Ex();
        $this->lfInitParam($objFormParam);
        $objFormParam->setParam($_POST);
        $objFormParam->convParam();

        $arrForm = array();
        switch ($this->getMode()) {
            case 'edit':
                $this->arrErr = $this->lfCheckError($objFormParam);
                $arrForm = $objFormParam->getHashArray();

                //If there are no errors, update the table.
                if (SC_Utils_Ex::isBlank($this->arrErr)) {
                    $this->updateData($arrForm);
                    $this->tpl_onload .= 'window.close();';
                }
                break;
            default:
                $arrForm['sampletext'] = $this->getdata();
                break;
        }
        $this->arrForm = $arrForm;
        $this->setTemplate($this->tpl_mainpage);
    }

    /**
     * Destructor.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }

    /**
     * Paramater info initialization 
     *
     * @param object $objFormParam SC_FormParam instance
     * @return void
     */
    function lfInitParam(&$objFormParam) {
        $objFormParam->addParam('Sampletext', 'sampletext', STEXT_LEN, ``, array('MAX_LENGTH_CHECK'));
    }

    /**
     * Check for errors of inputed data
     * @param Object $objFormParam
     * @return Array error 
     */
    function lfCheckError(&$objFormParam) {
        $objErr = new SC_CheckError_Ex();
        $objErr->arrErr = $objFormParam->checkError();
        return $objErr->arrErr;
    }

    /**
     * Select sampletext from table
     * 
     * @return data 
     */
    function getdata() {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $sql = "SELECT sampletext FROM plg_sampleplugin";
        $data = $objQuery->getOne($sql);
        return $data;
    }

    /**
     * Update sampletext and update_date in table
     * 
     * @param Array $arrData
     */
    function updateData($arrData) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $sqlval = array();
        $sqlval['sampletext'] = $arrData['sampletext'];
        $sqlval['update_date'] = 'CURRENT_TIMESTAMP';
        $objQuery->update('plg_sampleplugin', $sqlval);
    }

}

?>

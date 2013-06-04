<?php
/**
 *
 */

class marm_codelogin  extends oxAdminDetails
{
    /**
     * Executes parent method parent::render(), creates oxuser object,
	 * passes data to Smarty engine and returns name of template
     * file "marm_codelogin.tpl".
     *
     * @return string
     */
    public function render()
    {
        parent::render();

		$soxId = oxConfig::getParameter( "oxid" );
        if ( $soxId != "-1" && isset( $soxId ) ) {
            // load object
            $oUser = oxNew( "oxuser" );
            $oUser->load( $soxId );

            $this->_aViewData["edit"] =  $oUser;
        }

        if ( !$this->_allowAdminEdit( $soxId ) ) {
            $this->_aViewData['readonly'] = true;
        }

        return "marm_codelogin.tpl";
    }
	
	/**
	 * Generates and returns random string with fixed length
	 *
	 * @return string
	 */
	public function generateString() {
		$length = 10;
		$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$string = "";    

		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters)-1)];
		}
		return $string;
	}
	
	/**
	 * Calls method $this->generateString(), checks if string is unique and
	 * passes data to Smarty engine
	 *
	 */
	public function generateCode() {
		$oDB = oxDb::getDb();
        for ($p = 0; $p < 10; $p++) {
			$sCode = $this->generateString();
			$sQ = 'select oxid from oxuser where oxmarmcodelogin = '. $oDB->quote( $sCode );
			$oRs = $oDB->execute( $sQ );
			if ( $oRs != false && $oRs->recordCount() > 0 ){
				
			} else {
				$this->_aViewData["gen_done"] = true;
				$this->_aViewData["logincode"] = $sCode;
				break;
			}
		}

	}

	/**
	 * Collects parameters from POST, creates oxuser objects 
	 * and calls $oUser-save()
	 */
	public function save(){
		$soxId = oxConfig::getParameter( "oxid" );
		if ( $this->_allowAdminEdit( $soxId ) ) {

			$aParams = oxConfig::getParameter( "editval");

			$oUser = oxNew( "oxuser" );
			if ( $soxId != "-1" ) {
				$oUser->load( $soxId );
			} else {
				$aParams['oxuser__oxid'] = null;
			}
			
			// checkbox handling
			$aParams['oxuser__oxactive'] = $oUser->oxuser__oxactive->value;
			
			$oUser->assign( $aParams );
			
			$oUser->save();

			// set oxid if inserted
			if ( $soxId == "-1" ) {
				oxSession::setVar( "saved_oxid", $oUser->getId() );
			}
		}
	}
	
}
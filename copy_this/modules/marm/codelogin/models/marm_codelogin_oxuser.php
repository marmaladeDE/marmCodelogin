<?php
/**
 *
 */

class marm_codelogin_oxuser extends marm_codelogin_oxuser_parent
{
    /**
     * Performs user login by logincode. Fetches user data from DB.
     * Registers in session. Returns true on success, FALSE otherwise.
     *
     * @param string $sLoginCode     User LoginCode
     * @param bool   $blCookie  (default false)
     *
     * @throws oxConnectionException, oxCookieException, oxUserException
     *
     * @return bool
     */
    public function login_codelogin($sLoginCode, $blCookie = false)
    {
	
        $myConfig = $this->getConfig();
		
	if ( $sLoginCode ){
            $sShopID = $myConfig->getShopId();
            $oDb = oxDb::getDb();
			
            $sCodeSelect = " oxuser.marmcodelogin = " . $oDb->quote( $sLoginCode );
			
            $sWhat = "oxid";

            $sSelect =  "select $sWhat from oxuser where oxuser.oxactive = 1 and {$sCodeSelect} ";
			
            // load from DB
            $aData = $oDb->getAll( $sSelect );
            $sOXID = @$aData[0][0];
            if ( isset( $sOXID ) && $sOXID && !@$aData[0][1] ) {

                if ( !$this->load( $sOXID ) ) {
                    $oEx = oxNew( 'oxUserException' );
                    $oEx->setMessage( 'EXCEPTION_USER_NOVALIDLOGIN' );
                    throw $oEx;
                }
            }
		}
		
		//login successfull?
        if ( $this->oxuser__oxid->value ) {
            // yes, successful login
            oxSession::setVar( 'usr', $this->oxuser__oxid->value );

            // cookie must be set ?
            if ( $blCookie ) {
                oxUtilsServer::getInstance()->setUserCookie( $this->oxuser__oxusername->value, $this->oxuser__oxpassword->value, $myConfig->getShopId() );
            }

            //load basket from the database
            try {
                if ($oBasket = $this->getSession()->getBasket()) {
                    $oBasket->load();
                }

            } catch (Exception $oE) {
                //just ignore it
            }

            return true;
        } else {
            $oEx = oxNew( 'oxUserException' );
            $oEx->setMessage( 'EXCEPTION_USER_NOVALIDLOGIN' );
            throw $oEx;
        }
    }
}
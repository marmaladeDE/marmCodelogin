<?php
/**
 *
 */

class marm_codelogin_oxcmp_user extends marm_codelogin_oxcmp_user_parent
{
	/**
	 * Collects posted user information from posted variables ("lgn_code",
	 * "lgn_cook"), executes oxuser::login_codelogin() and checks if
     * such user exists.
     *
     * Session variables:
     * <b>usr</b>, <b>usr_err</b>
     *
     * Template variables:
     * <b>usr_err</b>
	 */
	public function login_codelogin(){
		
		$sLoginCode = oxconfig::getParameter( 'lgn_code' );
		$sCookie   = oxConfig::getParameter( 'lgn_cook' );
		$this->setLoginStatus( USER_LOGIN_FAIL );
		try {
			$oUser = oxNew( 'oxuser' );
			$oUser->login_codeLogin( $sLoginCode, $sCookie );
			$this->setLoginStatus( USER_LOGIN_SUCCESS );
		} catch (oxUserException $oEX ) {
			// for login component send excpetion text to a custom component (if defined)
            oxUtilsView::getInstance()->addErrorToDisplay( $oEx, false, true );
        } catch( oxCookieException $oEx ){
            oxUtilsView::getInstance()->addErrorToDisplay( $oEx );
        }
	}
}
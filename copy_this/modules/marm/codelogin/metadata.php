<?php
/**
 * marmalade GmbH
 * OXID module to login users with a single passphrase.
 *
 * PHP version 5
 *
 * @author   Joscha Krug <support@marmalade.de>
 * @license  MIT License http://www.opensource.org/licenses/mit-license.html
 * @version  2.0
 * @link     https://github.com/marmaladeDE/marmLaterReview
 */

/**
 * Metadata version
 */
$sMetadataVersion = '1.1';

$aModule = array(
    'id'          => 'marm/codelogin',
    'title'       => 'marmalade :: Codelogin',
    'description' => array(
        'de'    => 'Ermöglichen Sie den Login über ein einzelnes Passwort.',
        'en'    => 'Allow your users to login with a single passphrase.',
    ),
    'email'         => 'support@marmalade.de',
    'url'           => 'http://www.marmalade.de',
    'thumbnail'     => 'marmalade.jpg',
    'version'       => '2.0',
    'author'        => 'marmalade GmbH :: Jens Richter / Joscha Krug',
    'extend'    => array(
        'oxcmp_user'    => 'marm/codelogin/components/marm_codelogin_oxcmp_user',
        'oxuser'        => 'marm/codelogin/models/marm_codelogin_oxuser'
    ),
    'files'     => array(
        'marm_codelogin'    => 'marm/codelogin/controllers/admin/marm_codelogin.php'
    ),
    'templates' => array(
        'marm_codelogin.tpl' => 'marm/codelogin/views/admin/marm_codelogin.tpl',
    )
);
<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   http://www.webbehinds.com
 * @author    Sathish kumar S<info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES 
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
/* Define Paths */
define('__OSSN_VERIF__', ossn_route()->com . 'verified-account/');


function verified_account_init() {
	
	if (ossn_isLoggedin()) {
        ossn_register_action('verified/user', __OSSN_VERIF__ . 'actions/user/verified.php');
        ossn_register_action('unverify/user', __OSSN_VERIF__ . 'actions/user/unverify.php');
    }
	ossn_extend_view('css/ossn.default', 'css/verified-account');
	ossn_extend_view('js/opensource.socialnetwork', 'js/jquery.tipsy');
}

ossn_register_callback('ossn', 'init', 'verified_account_init');

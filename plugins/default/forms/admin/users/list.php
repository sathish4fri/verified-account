<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$search = input('search_users');
$users = new OssnUser;
$pagination = new OssnPagination;

if (!empty($search)) {
    $pagination->setItem($users->SearchSiteUsers($search));
} else {
    $pagination->setItem($users->getSiteUsers());
}
?>
<div class="row margin-top-10 sathish">
<table class="table ossn-users-list">
    <tbody>
    <tr class="table-titles">
        <th><?php echo ossn_print('name'); ?></th>
        <th><?php echo ossn_print('username'); ?></th>
        <th><?php echo ossn_print('email'); ?></th>
        <th><?php echo ossn_print('type'); ?></th>
        <th><?php echo ossn_print('lastlogin'); ?></th>
        <th><?php echo ossn_print('edit'); ?></th>
        <th><?php echo ossn_print('delete'); ?></th>
        <th>Status</th>
        <th>Verify User</th>  
    </tr>
    <?php foreach ($pagination->getItem() as $user) {
        $user = ossn_user_by_guid($user->guid);
        $lastlogin = '';
		if(!empty($user->last_login)){
			$lastlogin = ossn_user_friendly_time($user->last_login);
		}

$set = new OssnEntities;
$set->type ='user';
$set->subtype = 'verified';
$set->owner_guid = $user->guid;
$set->limit = '1';
$set = $set->get_entities(); 
?>
        <tr>
            <td>
                <div class="left image"><img src="<?php echo $user->iconURL()->smaller; ?>"/></div>
                <div class="name"><?php echo strl($user->fullname, 20); ?></div>
            </td>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->email; ?></td>
            <td><?php echo $user->type; ?></td>
            <td><?php echo $lastlogin; ?></td>
            <td>
                <a href="<?php echo ossn_site_url("administrator/edituser/{$user->username}"); ?>"><?php echo ossn_print('edit'); ?></a>
            </td>
            <td><a href="<?php echo ossn_site_url("action/admin/delete/user?guid={$user->guid}", true); ?>" class="userdelete"><?php echo ossn_print('delete'); ?></a></td>

<?php
if ($set[0]->value == 'true') {
?>
<td><p style="font-weight: bold; color: forestgreen;">Verified</p></td>
<td><a href="<?php echo ossn_site_url("action/unverify/user?guid={$user->guid}&verified=true", true); ?>" >unverify</a></td>
<?php
} else {
?>
<td></td>
<td>
<a href="<?php echo ossn_site_url("action/verified/user?guid={$user->guid}&verified=true", true); ?>" ><?php echo ossn_print('verify'); ?></a>
</td>
<?php
}
?>

</tr>
            <?php 
            } ?>
    </tbody>
</table>
</div>
<div class="row">
	<?php echo $pagination->pagination(); ?>
</div>

<?php
$guid = input('guid');

$user = ossn_user_by_guid($guid);
if($user->isAdmin()){
$userverifed = "ADMIN";
}else{
$userverifed = input('verified');
}

if(isset($guid)){
$set = new OssnEntities;
$set->type ='user';
$set->subtype = 'verified';
$set->owner_guid = $user->guid;
$set->limit = '1';
$set1 = $set->get_entities(); 

$userid= $set1[0]->guid;
if($set->deleteEntity($userid))
{
ossn_trigger_message('User Unverified', 'success');
   	redirect(REF);
}else
{
ossn_trigger_message('User Guid is wrong ', 'error');
   	redirect(REF);

}
}else{
	ossn_trigger_message('Please Enter the value ', 'error');
}

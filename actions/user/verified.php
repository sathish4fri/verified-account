<?php
$guid = input('guid');

$user = ossn_user_by_guid($guid);
if($user->isAdmin()){
$userverifed = "ADMIN";
}else{
$userverifed = input('verified');
}

if(isset($guid)){
$OssnEntities = new OssnEntities;
 $OssnEntities->type = 'user';
  $OssnEntities->subtype = 'verified';
  $OssnEntities->permission = OSSN_PUBLIC;
  $OssnEntities->value = $userverifed;
  $OssnEntities->owner_guid = $guid;

   if($OssnEntities->add()){   	
   	ossn_trigger_message('user verified');
   	redirect(REF);
   }
   else{

   	ossn_trigger_message('user not  verified');
   	redirect(REF);
   }
}else{
	ossn_trigger_message('Please Enter the value ', 'error');
}


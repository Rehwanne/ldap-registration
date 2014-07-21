<?php

require "init.php";

$username=$argv[1];


$stmt=$db->perpare('SELECT `password`,`date`,`ip` FROM regs WHERE username = ?');
$stmt->bind_param('s',$username);
$stmt->execute();
$stmt->bind_result($password,$date,$ip);

if(!$stmt->fetch()) {
	die('user not found');
}

$info=array();
$info["objectClass"] =array();
$info["objectClass"][] = "top";
$info["objectClass"][] = "inetOrgPerson";
$info["objectClass"][] = "posixAccount";
$info["objectClass"][] = "shadowAccount";
$info["uid"]=$username;
$info["homeDirectory"] = "/var/vhome/"+$username;
$info["givenName"] = $username;
$info["sn"] = $username;
$info["displayName"] = $username;
$info["cn"] = $username;
$info["mail"] = $username+"@milliways.info";
$info["userPassword"] = "{crypt}" . $password;


$add = ldap_add($ldapconn, "ou=users,cn=milliways,cn=info", $info);
<?php

require "init.php";

$username=$argv[1];


$stmt=$db->prepare('DELETE FROM regs WHERE username = ?');
$stmt->bind_param('s',$username);
$stmt->execute();

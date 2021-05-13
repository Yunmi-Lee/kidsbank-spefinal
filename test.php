<?php

 echo "------test-------";


 // Include config file
 require_once "config.php";

 $uid = 1;
 $gname = "lala";

 $link->set_charset('utf8mb4'); // always set the charset
 $stmt = $link->prepare("SELECT * FROM goal WHERE user_id=? AND goal_name=? limit 1");
 $stmt->bind_param('ss', $uid, $gname);
 $stmt->execute();


 $result = $stmt->get_result();
 $value = $result->fetch_object();

 $cmoney = $value->current_amount;
 $tmoney = $value->goal_amount;
 $prog = round(($cmoney/$tmoney)*100, 1);
 $gdate = $value->duedate;

 echo $cmoney;
 echo "----------";
 echo $tmoney;
 echo "----------";
 echo $prog;
 echo "----------";
 echo $gdate;
 echo "----------";


/*
 $param1 = 1;
 $param2 = "christmas";
 $amount = 5;

 //update current money
 $link->set_charset('utf8mb4'); // always set the charset
 $stmt = $link->prepare("SELECT current_amount FROM goal WHERE user_id=? AND goal_name=? limit 1");
 $stmt->bind_param('ss', $param1, $param2);
 $stmt->execute();

 $result = $stmt->get_result();
 $value = $result->fetch_object();
 $camount = $value->current_amount;

 echo $camount;
 echo "----------";

 $camount = $camount + $amount;

 echo $camount;
 echo "----------";

 //update goal
 $query = $link->prepare("UPDATE goal SET current_amount=? WHERE user_id=? AND goal_name=?");
 $query->bind_param('sss', $camount, $param1, $param2);
 $query->execute();
*/

 // Close connection
 mysqli_close($link);

 ?>

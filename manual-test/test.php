<?php

echo "------test-------";

// Include config file
require_once "config.php";

//define variables for goal statistics
$comp_total = 0;
$goal_total = 0;
$active_total = 0;
$current_total = 0;
$left_total = 0;
$total_amount = 0;
$saved_total_p_goal = 0;
$inx = 1;

$chart = array ( //2x20 two dimensional array
  array("NULL", 0), array("NULL", 0), array("NULL", 0), array("NULL", 0),
  array("NULL", 0), array("NULL", 0), array("NULL", 0), array("NULL", 0),
  array("NULL", 0), array("NULL", 0), array("NULL", 0), array("NULL", 0),
  array("NULL", 0), array("NULL", 0), array("NULL", 0), array("NULL", 0),
  array("NULL", 0), array("NULL", 0), array("NULL", 0), array("NULL", 0)
);

//define variables for transaction statistics
$saved_total = 0;
$minus_total = 0;
$trans_total = 0;
$balance = 0;
$avg_trans = 0;


$user = 23;
$link->set_charset('utf8mb4'); // always set the charset

//goal statistics
$query = $link->prepare("SELECT * FROM goal WHERE user_id=?");
$query->bind_param('s', $user);
$query->execute();

if ($result = $query->get_result()) {
        while($value = $result->fetch_object()) {
            $goal_total++;
            if ($value->iscomplete) {
                $comp_total++;
            } else {
                $active_total++;
            }

            $current_total += $value->current_amount;
            $total_amount += $value->goal_amount;

            //find transaction
            $gname = $value->goal_name;

            $stmt = $link->prepare("SELECT * FROM trans WHERE user_id=? and goal_name=?");
            $stmt->bind_param('ss', $user, $gname);
            $stmt->execute();

            if ($result1 = $stmt->get_result()) {
                    while($value = $result1->fetch_object()) {

                        if($value->plus) { //plus
                            $saved_total_p_goal += $value->trans_amount;
                        } else { //minus
                            $saved_total_p_goal -= $value->trans_amount;
                        }
                    }
                    $chart[$inx++] = array($gname, $saved_total_p_goal);
                    $saved_total_p_goal = 0;
                    $result1->free();
            }
        }

        $left_total = $total_amount - $current_total;
        $result->free();
}

echo $comp_total;
echo "----------";
echo $goal_total;
echo "----------";
echo $active_total;
echo "----------";
echo $current_total;
echo "----------";
echo $left_total;
echo "----------";
echo $total_amount;
echo "----------";
echo PHP_EOL;

echo $chart[1][0];
echo "----------";
echo $chart[1][1];
echo "----------";
echo PHP_EOL;


//transaction statistics
$query1 = $link->prepare("SELECT * FROM trans WHERE user_id=?");
$query1->bind_param('s', $user);
$query1->execute();

if ($result2 = $query1->get_result()) {
        while($value = $result2->fetch_object()) {
            if($value->plus) { //plus
                $saved_total += $value->trans_amount;
            } else { //minus
                $minus_total += $value->trans_amount;
            }
            $trans_total++;
        }
        $balance = $saved_total - $minus_total;
        $avg_trans = round($balance/$trans_total,1);
        $result2->free();
}

echo $saved_total;
echo "----------";
echo $minus_total;
echo "----------";
echo $trans_total;
echo "----------";
echo $balance;
echo "----------";
echo $avg_trans;
echo "----------";

// Close connection
mysqli_close($link);

?>

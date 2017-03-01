<?php
/** @var \app\models\WG $wg */
/** @var string $account_id */
/** @var string $search */
/** @var string $eff */
/** @var string $wn8 */

echo '<pre>';
if ($account_id ) {
    echo "<br>$search";
    echo "<br>Account_id: $account_id";
    echo "<br>Эфф: " . $eff;
    echo "<br>WN8: " . $wn8;
}
echo '</pre>';
?>
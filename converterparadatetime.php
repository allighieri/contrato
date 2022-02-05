<?php
$originalDate = "29/01/2020 10:47:00";
$DateTime = DateTime::createFromFormat('d/m/Y h:s:i', $originalDate);
$newDate = $DateTime->format('Y-m-d h:s:i');
echo "The new date is $newDate.";
?>	
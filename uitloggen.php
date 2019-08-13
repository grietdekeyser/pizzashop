<?php

//uitloggen.php

setcookie("klantId", "", 1);
setcookie("cart", "", 1);
header("location: index.php");
exit(0);
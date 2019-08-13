<?php

//Data/PostcodeDAO.php

namespace Data;

use Data\DBConfig;
use \PDO;
use Entities\Postcode;
use Exceptions\NoDeliveryException;
require_once("DBConfig.php");
require_once("Entities/Postcode.php");
require_once("Exceptions/NoDeliveryException.php");

class PostcodeDAO {
    public function getAll() : array {
        $sql = "select postcodeid, postcode, gemeente from leveringsgebied order by postcode asc";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);

        $lijst = [];
        foreach ($resultSet as $rij) {
            $postcode = Postcode::create($rij["postcodeid"], $rij["postcode"], $rij["gemeente"]);
            array_push($lijst, $postcode);
        }
        if (empty($lijst)) {
            throw new NoDeliveryException;
        }
        $dbh = null;
        return $lijst;
    }
}
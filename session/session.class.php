<?php

# File created using Visual Studio Code: https://code.visualstudio.com/
# Created by Naisend


if (!defined("DOCUMENT_ROOT")) {
    define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
}
/** Include the database connection file. This file makes the connection to database and is needed here */
require_once DOCUMENT_ROOT . '/db/dbconnection.php';


/** Define database configuration */
define("DB_HOST", CONFIGS::DB_SERVER);
define("DB_USER", CONFIGS::DB_USERNAME);
define("DB_PASS", CONFIGS::DB_PASSWORD);
define("DB_NAME", CONFIGS::DB_NAME);

class Database
{
    private $host      = DB_HOST;
    private $user      = DB_USER;
    private $pass      = DB_PASS;
    private $dbname    = DB_NAME;
    private $dbh;
    private $error;
    private $stmt;

    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    public function execute()
    {
        return $this->stmt->execute();
    }

    public function resultset()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

    public function beginTransaction()
    {
        return $this->dbh->beginTransaction();
    }

    public function endTransaction()
    {
        return $this->dbh->commit();
    }

    public function cancelTransaction()
    {
        return $this->dbh->rollBack();
    }

    public function debugDumpParams()
    {
        return $this->stmt->debugDumpParams();
    }

    public function close()
    {
        $this->dbh = null;
    }
}


class Session
{
    private $db;

    public function __construct()
    {
        // Instantiate new Database object
        $this->db = new Database;

        // Set handler to overide SESSION
        session_set_save_handler(
            array($this, "open"),
            array($this, "close"),
            array($this, "read"),
            array($this, "write"),
            array($this, "destroy"),
            array($this, "gc")
        );

        // Start the session
        session_start();
    }
    public function open()
    {
        // If successful
        if ($this->db) {
            // Return True
            return true;
        }
        // Return False
        return false;
    }
    public function close()
    {
        // Close the database connection
        // If successful
        if ($this->db->close()) {
            // Return True
            return true;
        }
        // Return False
        return false;
    }
    public function read($id)
    {
        // Set query
        $this->db->query('SELECT `Session_Data` FROM `sessions` WHERE id = :id');
        // Bind the Id
        $this->db->bind(':id', $id);
        // Attempt execution
        // If successful
        if ($this->db->execute()) {
            // Save returned row
            $row = $this->db->single();
            // Return the Session_Data
            $session_data = $row['Session_Data'];
            if (is_null($session_data)) {
                $session_data = '';//use empty string instead of null!
            }
            return $session_data;
        } else {
            // Return an empty string
            return '';
        }
    }
    public function write($id, $Session_Data)
    {
        // Create time stamp
        $access = time();
        $accesstime = date("Y-m-d H:i:s", $access);
        // Regex parse ownerid from userid
        $ownerid = preg_match('/userid\|i:(\d+)\;/', $Session_Data, $matches) ? $matches[1] : '';
        try {
            // Set query
            $this->db->query('REPLACE INTO sessions (`id`,`ownerid`,`access`,`accesstime`,`Session_Data`) VALUES (:id, :ownerid, :access, :accesstime, :Session_Data)');
            // Bind Session_Data
            $this->db->bind(':id', $id);
            $this->db->bind(':ownerid', $ownerid);
            $this->db->bind(':access', $access);
            $this->db->bind(':accesstime', $accesstime);
            $this->db->bind(':Session_Data', $Session_Data);
            // Attempt Execution
            // If successful
            if ($this->db->execute()) {
                // Return True
                return true;
            }
        } catch (Exception $e) {
            // Set query
            $this->db->query('REPLACE INTO sessions (`id`,`ownerid`,`access`,`Session_Data`) VALUES (:id, :ownerid, :access, :Session_Data)');
            // Bind Session_Data
            $this->db->bind(':id', $id);
            $this->db->bind(':ownerid', $ownerid);
            $this->db->bind(':access', $access);
            $this->db->bind(':Session_Data', $Session_Data);
            // Attempt Execution
            // If successful
            if ($this->db->execute()) {
                // Return True
                return true;
            }
        }
        // Return False
        return false;
    }
    public function destroy($id)
    {
        // Set query
        $this->db->query('DELETE FROM sessions WHERE id = :id');
        // Bind Session_Data
        $this->db->bind(':id', $id);
        // Attempt execution
        // If successful
        if ($this->db->execute()) {
            // Return True
            return true;
        }
        // Return False
        return false;
    }
    public function gc($max)
    {
        // Calculate what is to be deemed old
        $old = time() - $max;
        // Set query
        $this->db->query('DELETE FROM sessions WHERE access < :old');
        // Bind Session_Data
        $this->db->bind(':old', $old);
        // Attempt execution
        if ($this->db->execute()) {
            // Return True
            return true;
        }
        // Return False
        return false;
    }
    public function trim($max_life)
    {
        // Calculate what is to be deemed old
        $aged = time() - $max_life;
        // Set query
        $this->db->query('DELETE FROM sessions WHERE access < :aged');
        // Bind Session_Data
        $this->db->bind(':aged', $aged);
        // Attempt execution
        if ($this->db->execute()) {
            // Return True
            return true;
        }
        // Return False
        return false;
    }
}

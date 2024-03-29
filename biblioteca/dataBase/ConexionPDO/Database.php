<?php

include_once (is_file('../ConfigDB.php')) ? '../ConfigDB.php' : 'ConfigDB.php';

class Database { 

    /**
     * The singleton instance
     * 
     */
    static private $PDOInstance;
    private $port = 5432;
    protected $transactionCounter = 0;
    public $transactionStatus = true; //Cuando se crea la transacción y genera Error, pasa a estado false.
    public $transactionMessage = array();
    public $debug = false;
    private static $instance = NULL;

    /**
     *  Controla los estado de las transacciones generadas por la APP 
     *  0: No se inicia la transaccion.
     *  1: Inicia la transaccion.
     *  2: Error en la transaccion
     *
     * @var integer
     */
    public $transactionState = 0;

    /**
     * Creates a PDO instance representing a connection to a database and makes the instance available as a singleton
     * 
     * @param string $dsn The full DSN, eg: mysql:host=localhost;dbname=testdb
     * @param string $username The user name for the DSN string. This parameter is optional for some PDO drivers.
     * @param string $password The password for the DSN string. This parameter is optional for some PDO drivers.
     * @param array $driver_options A key=>value array of driver-specific connection options
     * 
     * @return PDO
     */
    public function __construct($ConfigDB = '') {
        if (!self::$PDOInstance) {
            try {
                if (empty($ConfigDB)) {
                    global $ConfigDB;
                }
                self::$PDOInstance = new PDO("pgsql:host=$ConfigDB[dbhost];port=$this->port;dbname=$ConfigDB[dbname];user=$ConfigDB[dbuser];password=$ConfigDB[dbpass]");
                self::$PDOInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("PDO CONNECTION ERROR: " . $e->getMessage() . "<br/>");
            }
        }
        return self::$PDOInstance;
    }

    public function __destruct() {
        
    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            if (empty($ConfigDB)) {
                global $ConfigDB;
            }
            self::$instance = new Database($ConfigDB);
        }
        return self::$instance;
    }

    /**
     * Initiates a transaction
     *
     * @return bool
     */
    public function beginTransaction() {
        $this->printMensajeErrorTransaccion("INICIO LA TRANSACCION PDO");
        $this->transactionState = 1;
        if (!$this->transactionCounter++) {
            return self::$PDOInstance->beginTransaction();
        }
        $query = 'SAVEPOINT trans' . $this->transactionCounter;
        $this->exec($query);        
        return $this->transactionCounter >= 0;
    }

    /**
     * Rolls back a transaction
     *
     * @return bool
     */
    public function rollBack() {
        if ($this->transactionState === 0) {
            return false;
        }
        $this->printMensajeErrorTransaccion("EJECUTO ROLLBACK PDO");
        if (--$this->transactionCounter) {
            $query = 'ROLLBACK TO trans' . ($this->transactionCounter + 1);
            $this->exec($query);
            return true;
        }
        $this->transactionState = 0;
        return self::$PDOInstance->rollback();
    }

    /**
     * Commits a transaction
     *
     * @return bool
     */
    public function commit() {
        if ($this->transactionState === 0) {
            return false;
        }
        $this->printMensajeErrorTransaccion("EJECUTO COMMIT PDO");
        $this->transactionState = 0;
        $this->transactionCounter = 0;
        return self::$PDOInstance->commit();
    }

    /**
     * Fetch the SQLSTATE associated with the last operation on the database handle
     * 
     * @return string 
     */
    public function errorCode() {
        return self::$PDOInstance->errorCode();
    }

    /**
     * Fetch extended error information associated with the last operation on the database handle
     *
     * @return array
     */
    public function errorInfo() {
        return self::$PDOInstance->errorInfo();
    }

    /**
     * Execute an SQL statement and return the number of affected rows
     *
     * @param string $statement
     */
    public function exec($statement) {
        return self::$PDOInstance->exec($statement);
    }

    /**
     * Retrieve a database connection attribute
     *
     * @param int $attribute
     * @return mixed
     */
    public function getAttribute($attribute) {
        return self::$PDOInstance->getAttribute($attribute);
    }

    /**
     * Return an array of available PDO drivers
     *
     * @return array
     */
    public function getAvailableDrivers() {
        return Self::$PDOInstance->getAvailableDrivers();
    }

    /**
     * Executes an SQL statement, returning a result set as a PDOStatement object
     *
     * @param string $statement
     * @return PDOStatement
     */
    public function query($statement) {
        return self::$PDOInstance->query($statement);
    }

    /**
     * Quotes a string for use in a query
     *
     * @param string $input
     * @param int $parameter_type
     * @return string
     */
    public function quote($input, $parameter_type = 0) {
        return self::$PDOInstance->quote($input, $parameter_type);
    }

    public function close_con() {
        
    }

    /**
     * Set an attribute
     *
     * @param int $attribute
     * @param mixed $value
     * @return bool
     */
    public function setAttribute($attribute, $value) {
        return self::$PDOInstance->setAttribute($attribute, $value);
    }

    /**
     * Prepares a statement for execution and returns a statement object 
     *
     * @param string $statement A valid SQL statement for the target database server
     * @param array $driver_options Array of one or more key=>value pairs to set attribute values for the PDOStatement obj 
      returned
     * @return PDOStatement
     */
    public function prepare($statement, $driver_options = false) {
        if (!$driver_options)
            $driver_options = array();
        return self::$PDOInstance->prepare($statement, $driver_options);
    }

    public function queryInsert($query, $data = null) {
        $this->printQueryEcho($query, $data, 'queryInsert');
        $status = true;
        $response = null;
        $message = '';
        try {
            $resultado = $this->prepare($query);
            $response = $resultado->execute($data);
        } catch (PDOException $exc) {
            $status = false;
            $message = utf8_encode($exc->getMessage());
            if ($this->transactionCounter > 0) {
                $this->transactionStatus = false;
            }
            if ($this->transactionState === 1) {
                $this->transactionState = 2;
            }
            $this->transactionMessage[] = $message;
            $this->printQuery($message, $query, $data);
        }
        return (object) array('status' => $status, 'response' => $response, 'errorSQL' => $message);
    }

    public function querySelectFetchRowAssoc($query, $data = null) {
        $this->printQueryEcho($query, $data, 'querySelectFetchRowAssoc');
        $status = true;
        $response = false;
        $message = '';
        try {
            $resultado = $this->prepare($query);
            $resultado->execute($data);
            $response = $resultado->fetch(PDO::FETCH_ASSOC);
            if ($response === false) {
                $response = array();
            }
        } catch (PDOException $exc) {
            $status = false;
            $message = utf8_encode($exc->getMessage());
            if ($this->transactionCounter > 0) {
                $this->transactionStatus = false;
            }
            if ($this->transactionState === 1) {
                $this->transactionState = 2;
            }
            $this->transactionMessage[] = $message;
            $this->printQuery($message, $query, $data);
        }
        $response = !empty($response) ? $response : NULL;
        return (object) array('status' => $status, 'response' => $response, 'errorSQL' => $message);
    }

    public function querySelectFetchAllAssoc($query, $data = null) {
        $this->printQueryEcho($query, $data, 'querySelectFetchAllAssoc');
        $status = true;
        $response = false;
        $message = '';
        try {
            $resultado = $this->prepare($query);
            $resultado->execute($data);
            $response = $resultado->fetchAll(PDO::FETCH_ASSOC);
            if ($response === false) {
                $response = array();
            }
        } catch (PDOException $exc) {
            $status = false;
            $message = utf8_encode($exc->getMessage());
            if ($this->transactionCounter > 0) {
                $this->transactionStatus = false;
            }
            if ($this->transactionState === 1) {
                $this->transactionState = 2;
            }
            $this->transactionMessage[] = $message;
            $this->printQuery($message, $query, $data);
        }
        $response = !empty($response) ? $response : NULL;
        return (object) array('status' => $status, 'response' => $response, 'errorSQL' => $message);
    }

    public function selectPointer($query, $data = null) {
        $this->printQueryEcho($query, $data, 'selectPointer');
        $status = true;
        $response = false;
        $message = '';
        try {
            $resultado = $this->prepare($query);
            $resultado->execute($data);
            return $resultado;
        } catch (PDOException $exc) {
            $status = false;
            $message = utf8_encode($exc->getMessage());
            if ($this->transactionCounter > 0) {
                $this->transactionStatus = false;
            }
            if ($this->transactionState === 1) {
                $this->transactionState = 2;
            }
            $this->transactionMessage[] = $message;
            $this->printQuery($message, $query, $data);
        }
        return (object) array('status' => $status, 'response' => $response, 'errorSQL' => $message);
    }

    public function querySelectFetchRowAssocObject($query, $data = null) {
        $this->printQueryEcho($query, $data, 'querySelectFetchRowAssocObject');
        $status = true;
        $response = false;
        $message = '';
        try {
            $resultado = $this->prepare($query);
            $resultado->execute($data);

            $response = $resultado->fetch(PDO::FETCH_OBJ);

            if ($response === false) {
                $response = array();
            }
        } catch (PDOException $exc) {
            $status = false;
            $message = utf8_encode($exc->getMessage());
            if ($this->transactionCounter > 0) {
                $this->transactionStatus = false;
            }
            if ($this->transactionState === 1) {
                $this->transactionState = 2;
            }
            $this->transactionMessage[] = $message;
        }
        return (object) array('status' => $status, 'response' => $response, 'errorSQL' => $message);
    }

    public function querySelectFetchAllAssocObject($query, $data = null) {
        $this->printQueryEcho($query, $data, 'querySelectFetchAllAssocObject');
        $status = true;
        $response = false;
        $message = '';
        try {
            $resultado = $this->prepare($query);
            $resultado->execute($data);
            $response = $resultado->fetchAll(PDO::FETCH_OBJ);
            if ($response === false) {
                $response = array();
            }
        } catch (PDOException $exc) {
            $status = false;
            $message = utf8_encode($exc->getMessage());
            if ($this->transactionCounter > 0) {
                $this->transactionStatus = false;
            }
            if ($this->transactionState === 1) {
                $this->transactionState = 2;
            }
            $this->transactionMessage[] = $message;
            $this->printQuery($message, $query, $data);
        }
        return (object) array('status' => $status, 'response' => $response, 'errorSQL' => $message);
    }

    public function executeQuery($query) {
        $this->printQueryEcho($query, null, 'execute');
        $status = true;
        $response = null;
        $message = '';
        try {
            $response = $this->exec($query);
        } catch (PDOException $exc) {
            $status = false;
            $message = utf8_encode($exc->getMessage());
            if ($this->transactionCounter > 0) {
                $this->transactionStatus = false;
            }
            if ($this->transactionState === 1) {
                $this->transactionState = 2;
            }
            $this->transactionMessage[] = $message;
            $this->printQuery($message, $query, null);
        }
        return (object) array('status' => $status, 'response' => $response, 'errorSQL' => $message);
    }

    public function getFields($query, $data = null) {
        $this->printQueryEcho($query, $data, 'getFields');
        $resultado = false;
        $eof = true;
        $status = true;
        $message = '';
        try {
            $resultado = $this->prepare($query);
            $resultado->execute($data);
            $eof = !($resultado->rowCount() > 0);
        } catch (PDOException $exc) {
            $status = false;
            $message = utf8_encode($exc->getMessage());
            if ($this->transactionCounter > 0) {
                $this->transactionStatus = false;
            }
            if ($this->transactionState === 1) {
                $this->transactionState = 2;
            }
            $this->transactionMessage[] = $message;
            $this->printQuery($message, $query, $data);
        }
        return (object) array('status' => $status, 'fields' => $resultado->fetch(PDO::FETCH_NUM), 'EOF' => $eof, 'errorSQL' => $message);
    }

    public function getFieldsAssoc($query, $data = null) {
        $this->printQueryEcho($query, $data, 'getFieldsAssoc');
        $resultado = false;
        $eof = true;
        $status = true;
        $message = '';
        try {
            $resultado = $this->prepare($query);
            $resultado->execute($data);
            $eof = !($resultado->rowCount() > 0);
        } catch (PDOException $exc) {
            $status = false;
            $message = utf8_encode($exc->getMessage());
            if ($this->transactionCounter > 0) {
                $this->transactionStatus = false;
            }
            if ($this->transactionState === 1) {
                $this->transactionState = 2;
            }
            $this->transactionMessage[] = $message;
            $this->printQuery($message, $query, $data);
        }
        return (object) array('status' => $status, 'fields' => $resultado->fetch(PDO::FETCH_ASSOC), 'EOF' => $eof, 'errorSQL' => $message);
    }

    public function querySelectFetchAllAssocNumerics($query, $data = null) {
        $this->printQueryEcho($query, $data, 'querySelectFetchAllAssocNumerics');
        $status = true;
        $response = false;
        $message = '';
        try {
            $resultado = $this->prepare($query);
            $resultado->execute($data);
            $response = $resultado->fetchAll(PDO::FETCH_NUM);
            if ($response === false) {
                $response = array();
            }
        } catch (PDOException $exc) {
            $status = false;
            $message = utf8_encode($exc->getMessage());
            if ($this->transactionCounter > 0) {
                $this->transactionStatus = false;
            }
            if ($this->transactionState === 1) {
                $this->transactionState = 2;
            }
            $this->transactionMessage[] = $message;
            $this->printQuery($message, $query, $data);
        }
        $response = !empty($response) ? $response : NULL;
        return (object) array('status' => $status, 'response' => $response, 'errorSQL' => $message);
    }

    public function getColumFieldsAll($query, $data = null) {
        $this->printQueryEcho($query, $data, 'getColumFieldsAll');
        $resultado = false;
        $eof = true;
        $status = true;
        $message = '';
        try {
            $resultado = $this->prepare($query);
            $resultado->execute($data);
            $eof = !($resultado->rowCount() > 0);
        } catch (PDOException $exc) {
            $status = false;
            $message = utf8_encode($exc->getMessage());
            if ($this->transactionCounter > 0) {
                $this->transactionStatus = false;
            }
            if ($this->transactionState === 1) {
                $this->transactionState = 2;
            }
            $this->transactionMessage[] = $message;
            $this->printQuery($message, $query, $data);
        }
        return (object) array('status' => $status, 'fields' => $resultado->fetchAll(PDO::FETCH_COLUMN), 'EOF' => $eof, 'errorSQL' => $message);
    }

    public function insertMultiArray($nameTable, $columns, $rows) {
        $params = implode(",", array_fill(0, count($rows[0]), "?"));
        $values = "(" . implode("),(", array_fill(0, count($rows), $params)) . ")";
        $param = call_user_func_array("array_merge", $rows);
        $query = "INSERT INTO $nameTable (" . implode(',', $columns) . ") VALUES $values;";
        return $this->queryInsert($query, $param);
    }

    private function printQuery($message, $query, $data) {
        $name = "cache/ERRORES_BASE_DATOS";
        if (!file_exists($name)) {
            mkdir($name, 0777, true);            
        }

        $result = debug_backtrace();
        $errorDebug = $result['1'];
        $errorDebugClass = $result['2'];

        $fecha = date("d-m-Y h:i:s");
        $error = "----------------------------------------INICIO FECHA: $fecha----------------------------------------" . PHP_EOL;
        $error .= "ARCHIVO: $errorDebug[file]" . PHP_EOL;
        $error .= "LINEA: $errorDebug[line]" . PHP_EOL;
        $error .= "FUNCION CLASE PDO: $errorDebug[function]" . PHP_EOL;
        $error .= "FUNCION CLASE: $errorDebugClass[function]" . PHP_EOL;
        $error .= "MENSAJE:" . PHP_EOL . "$message" . PHP_EOL;
        $error .= "CONSULTA:" . PHP_EOL . "$query" . PHP_EOL;
        $error .= "PARAMETROS:" . PHP_EOL . var_export($data, true) . PHP_EOL;
        $error .= "----------------------------------------FIN FECHA: $fecha----------------------------------------" . PHP_EOL;

        $nameFile = $name . "/ErroresConexionPDO.sql";
        $file = fopen($nameFile, "a+");
        fwrite($file, $error . PHP_EOL);
        fclose($file);
        if (file_exists($nameFile)) {
            chmod($nameFile, 0777);
        }

        $host = $_SERVER['HTTP_HOST'];
        if ($host === 'localhost' || $host === 'dusoftdev.cosmitet.net' || $host === 'migracion.cosmitet.net') {
            echo"<pre><hr><br>";
            echo utf8_decode($error);
            echo"</pre><br>";
            die();
        }
    }

    private function printQueryEcho($query, $param, $typeFunction) {
        $consulta = trim($query);
        if (empty($consulta)) {
            $result = debug_backtrace();
            $errorDebug = $result['1'];
            $errorDebugClass = $result['2'];
            $message = "EL SCRIPT PARA EJECUTAR A LA BASE DE DATOS ESTA VACIO<br>";
            $fecha = date("d-m-Y h:i:s");
            $error = "----------------------------------------INICIO FECHA: $fecha----------------------------------------" . PHP_EOL;
            $error .= "ARCHIVO: $errorDebug[file]" . PHP_EOL;
            $error .= "LINEA: $errorDebug[line]" . PHP_EOL;
            $error .= "FUNCION CLASE PDO: $errorDebug[function]" . PHP_EOL;
            $error .= "FUNCION CLASE: $errorDebugClass[function]" . PHP_EOL;
            $error .= "MENSAJE:" . PHP_EOL . "$message" . PHP_EOL;
            $error .= "----------------------------------------FIN FECHA: $fecha----------------------------------------" . PHP_EOL;
            echo"<pre><b>Data[]</b><br>$error<br>";
            print_r($query);
            echo"</pre><br>";
            die();
        }
        if ($this->debug) {

            $result = debug_backtrace();
            $errorDebug = $result['1'];

            $error = "ARCHIVO: $errorDebug[file]<br>";
            $error .= "LINEA: $errorDebug[line]<br>";

            echo"<pre><b>Data[$typeFunction]</b><br>$error<br>";
            print_r($query);
            echo "<br>";
            print_r($param);
            echo"</pre><br>";
        }
    }

    private function printMensajeErrorTransaccion($param) {
        $result = debug_backtrace();
        $errorDebug = $result['1'];
        $errorDebugClass = $result['2'];
        $error = '';
        $module = DIRECTORY_SEPARATOR . "hc_modules" . DIRECTORY_SEPARATOR;

        if (strpos($errorDebug['file'], $module) !== false) {

            $name = "cache/TRANSACCION_PDO";
            if (!file_exists($name)) {
                mkdir($name, 0777, true);           
            }

            $fecha = date("d-m-Y h:i:s");
            $error = "----------------------------------------INICIO $param FECHA: $fecha----------------------------------------" . PHP_EOL;
            $error .= "ARCHIVO: $errorDebug[file]" . PHP_EOL;
            $error .= "LINEA: $errorDebug[line]" . PHP_EOL;
            $error .= "FUNCION CLASE PDO: $errorDebug[function]" . PHP_EOL;
            $error .= "FUNCION CLASE: $errorDebugClass[function]" . PHP_EOL;
            $error .= "----------------------------------------FIN $param FECHA: $fecha----------------------------------------" . PHP_EOL;
            $nameFile = $name . "/" . str_replace(" ", "_", $param) . ".sql";
            $file = fopen($nameFile, "a+");
            fwrite($file, $error . PHP_EOL);
            fclose($file);

            if (file_exists($nameFile)) {
                chmod($nameFile, 0777);
            }
        }
    }

    public function error(){
        if(is_array($this->transactionMessage)){
            return implode(",", $this->transactionMessage);
        }
        return $this->transactionMessage;
    }
}

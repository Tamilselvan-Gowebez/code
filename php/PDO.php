<?php 

// Table names
//==============================================================
if(!defined('TBL'))
    define('TBL', 'table_name');

# DB connection variables
# ==============================================================
switch ($_SERVER['HTTP_HOST']) {

    case 'localhost':

        # Localhost db connection variables
        # ==============================================================
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'rnsights_members');
        define('DB_USER', 'dev_user');
        define('DB_PASS', 'user');

        break;

    case 'rnsightsmembers.rnsights.net':

        # Development rnsights.net db connection variables
        # ==============================================================
        define('DB_HOST', 'rnsights.com');
        define('DB_NAME', 'rnsights_members');
        define('DB_USER', 'rnsights_npiadm');
        define('DB_PASS', 'S@kth1us@');

        break;

    case 'rnsightsmembers.com':

        # production rnsights.com db connection variables
        # ==============================================================
        define('DB_HOST', 'rnsights.com');
        define('DB_NAME', 'rnsights_members');
        define('DB_USER', 'rnsights_npiadm');
        define('DB_PASS', 'S@kth1us@');

        break;

    default:

        echo "Status        : Error \n";
        echo "Error in      : Database connection variables definition \n";
        echo "Error Message : Database connection variables invalid. Please check defined variables are correct \n";
        echo "File Name     : " . __FILE__ . " \n";
        echo "Line Number   : " . __LINE__ . " \n";
        echo "\n\n";
        exit;
        break;
}

# DB Connection
# ==============================================================
$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";";

try {
    $instance = new PDO($dsn, DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {

    echo "Status        : Error \n";
    echo "Error in      : Database connection \n";
    echo "Error Message : " . $e->getMessage() . "\n";
    echo "File Name     : " . $e->getFile() . "\n";
    echo "Line Number   : " . $e->getLine() . "\n";
    exit;
}

// Database Connection for Rnsights Members
// ========================================
$_DB        = $instance;


try {

    $get  = $_DB->prepare("SELECT * FROM " . TBL);
    $get->execute([
        ':var' => $var
    ]);

    if ($get->rowCount() > 0) :

        $data    = $get->fetchAll(PDO::FETCH_ASSOC);

    endif;
} catch (PDOException $e) {
    error_log("\n
              Status        : Error \n
              Error in      : Database Query \n
              Error Message : " . $e->getMessage() . "\n
              File Name     : " . $e->getFile() . "\n
              Line Number   : " . $e->getLine() . "\n\n");
}

?>
<?

function db(): mysqli
{
    static $conn = null;
    if ($conn === null)
    {
        $conn = new mysqli('localhost', 'root', 'root', 'database', 3306);
        if ($conn->connect_errno)
        {
            echo 'Error connecting to database';
        }
    }
    return $conn;
}
?>

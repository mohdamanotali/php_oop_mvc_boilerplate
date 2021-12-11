<?php 

/**
 * this is a demo model
*/
namespace Core\Models;

require_once(MODEL_DIR.'/Database.php');
use Core\Models\Database;

class Rank extends Database
{
    private $database;

    public function __construct()
    {
        //echo "called rank model construct method<br/>";
        $this->database = new Database();
    }

    public function create(array $data)
    {
        $query = "INSERT INTO ranks(player_name, sport_name, total_usd, on_usd, off_usd) VALUES(?, ?, ?, ?, ?)";
        $params = [
            $data['player_name'],
            $data['sport_name'],
            $data['total_usd'],
            $data['on_usd'],
            $data['off_usd']
        ];
        return $this->database->_execute($query, $params);
    }

    public function read()
    {
        $query = "SELECT * FROM ranks ORDER BY total_usd DESC";
        $this->database->_execute($query);
        return $this->database->_fetchAll();
    }

    public function update(array $data)
    {
        $query = "UPDATE ranks SET player_name=?, sport_name=?, total_usd=?, on_usd=?, off_usd=? WHERE id=?";
        $params = [
            $data['player_name'],
            $data['sport_name'],
            $data['total_usd'],
            $data['on_usd'],
            $data['off_usd'],
            $data['id']
        ];
        return $this->database->_execute($query, $params);
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM ranks WHERE id=?";
        return $this->database->_execute($query, [$id]);
    }
}

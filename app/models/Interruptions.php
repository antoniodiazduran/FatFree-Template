<?php

class Interruptions extends DB\SQL\Mapper {

    public function __construct(DB\SQL $db) {
        parent::__construct($db,'interruptions');
    }

    public function all($company) {
        // Selecting data
        $sql  = 'SELECT *,';
        $sql .= '(SELECT title FROM products WHERE i.product = id) AS productName, ';
	$sql .= '(SELECT title FROM machines WHERE id = i.machine) AS machineName, ';
	$sql .= '(SELECT title FROM stations WHERE id = i.station) AS stationName, ';
	$sql .= '(SELECT city FROM sites WHERE id = i.site) AS siteName, ';
	$sql .= 'IF( i.type = "s", ';
	$sql .= ' (SELECT reason FROM scrap WHERE id = i.scrap), ';
	$sql .= ' (SELECT reason FROM downtime WHERE id = i.scrap) ';
	$sql .= ') as scrapName ';
	$sql .= 'FROM interruptions i WHERE company = ?';
        $result = $this->db->exec($sql,$company);
        return $result;
    }

    public function add() {
        // Add data
        $this->copyFrom('POST');
        $this->save();
    }

    public function getById($id) {
        // Getting data
        $this->load(array('id=?',$id));
        $this->copyTo('POST');
    }

    public function edit($id) {
        // Updating data
        $this->load(array('id=?',$id));
        $this->copyFrom('POST');
        $this->update();
    }

    public function delete($id) {
	    // Removing expense
        $this->load(array('id=?',$id));
        $this->erase();
    }

}
?>

<?php

class workstationmodel extends Model {

    public function dataList()
    {
        return $this->db->query('SELECT * FROM `workstationSystem` ORDER BY `workstationSystem`.`ws_Priority` DESC')->fetchAll(PDO::FETCH_ASSOC);
    }

}
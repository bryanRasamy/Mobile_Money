<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHistoryTypeOperationView extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE VIEW v_historique_type_operation AS 
            SELECT tp.nom_operation as nom_operation, hs.* 
            FROM type_operation as tp 
            JOIN historique as hs ON tp.id = hs.id_type;
        ");
    }

    public function down()
    {
        //
    }
}

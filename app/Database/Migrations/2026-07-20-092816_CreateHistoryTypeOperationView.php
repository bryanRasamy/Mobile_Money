<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHistoryTypeOperationView extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE view v_historique_type_operation_client AS 
            SELECT tp.nom_operation as nom_operation, hs.* , telephone, id_operateur, id_role, id_statut
            FROM type_operation as tp 
            JOIN historique as hs ON tp.id = hs.id_type 
            JOIN clients as cl ON cl.id=hs.id_client_depart;
        ");
    }

    public function down()
    {
        //
    }
}

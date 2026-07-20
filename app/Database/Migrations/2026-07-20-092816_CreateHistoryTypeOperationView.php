<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHistoryTypeOperationView extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE VIEW IF NOT EXISTS v_historique_type_operation_client AS 
            SELECT 
                tp.nom_operation AS nom_operation,
                hs.*,
                cl.telephone,
                cl.id_operateur,
                cl.id_role,
                cl.id_statut
            FROM type_operation AS tp
            JOIN historique AS hs 
                ON tp.id = hs.id_type
            JOIN clients AS cl 
                ON cl.id = hs.id_client_depart
        ");
    }

    public function down()
    {
        $this->db->query("
            DROP VIEW IF EXISTS v_historique_type_operation_client
        ");
    }
}

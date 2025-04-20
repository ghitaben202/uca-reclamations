<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CheckTableStructure extends Command
{
    protected $signature = 'db:check-structure';
    protected $description = 'Check the structure of agents and reclamations tables';

    public function handle()
    {
        $this->info('Checking table structure...');

        $tables = ['agents', 'reclamations'];

        foreach ($tables as $table) {
            $this->info("\nTable '$table' structure:");
            
            // Obtenir les colonnes
            $columns = Schema::getColumnListing($table);
            
            foreach ($columns as $column) {
                $type = DB::getSchemaBuilder()->getColumnType($table, $column);
                $nullable = !Schema::getConnection()->getDoctrineColumn($table, $column)->getNotnull();
                $default = Schema::getConnection()->getDoctrineColumn($table, $column)->getDefault();
                
                $this->line(sprintf(
                    "- %s: %s%s%s",
                    $column,
                    $type,
                    $nullable ? ' NULL' : ' NOT NULL',
                    $default ? " DEFAULT '$default'" : ''
                ));
            }

            // Obtenir les clés étrangères
            $foreignKeys = Schema::getConnection()
                ->getDoctrineSchemaManager()
                ->listTableForeignKeys($table);

            if (count($foreignKeys) > 0) {
                $this->info("\nForeign keys:");
                foreach ($foreignKeys as $foreignKey) {
                    $this->line(sprintf(
                        "- %s references %s(%s)",
                        implode(', ', $foreignKey->getLocalColumns()),
                        $foreignKey->getForeignTableName(),
                        implode(', ', $foreignKey->getForeignColumns())
                    ));
                }
            }
        }

        return 0;
    }
} 
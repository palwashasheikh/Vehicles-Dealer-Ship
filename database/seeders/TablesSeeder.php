<?php

namespace Database\Seeders;


use App\Models\Column;
use App\Models\Table;
use Illuminate\Database\Seeder;

class TablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->tables() as $schema) {
            $this->addTableAndColumnConfigs(app($schema));
        }
    }

    public function tables(): array
    {
        // Do not change order
        return [
            
        ];
    }

    protected function addTableAndColumnConfigs(DatatableSchema $schema): void
    {
        $tableSchema = $schema::table();

        $table = Table::updateOrCreate(['table_name' => $tableSchema['table_name']], $tableSchema);
        $this->updateOrCreateColumns($schema, $table);
    }

    protected function updateOrCreateColumns(DatatableSchema $schema, Table $table): void
    {
        $columns = [];

        foreach ($schema::columns() as $column) {
            $columns[] = $column['name'];
            Column::updateOrCreate(['table_id' => $table->id, 'name' => $column['name']], $column);
        }

        $this->removeRedundantColumns($table, $columns);
    }

    protected function removeRedundantColumns(Table $table, $columns): void
    {
        Column::where('table_id',  $table->id)->whereNotIn('name', $columns)->delete();
    }
}

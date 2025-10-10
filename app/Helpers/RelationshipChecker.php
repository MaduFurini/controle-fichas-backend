<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RelationshipChecker
{
    public static function hasRelationship(string $field, $value): bool
    {
        $tables = DB::select('SHOW TABLES');
        $column = 'Tables_in_' . DB::getDatabaseName();

        foreach ($tables as $table) {
            $tableName = $table->$column;

            if (Schema::hasColumn($tableName, $field)) {
                $exists = DB::table($tableName)
                    ->where($field, $value)
                    ->exists();

                if ($exists) return true;
            }
        }

        return false;
    }
}

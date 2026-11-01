<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class VoucherSchemaMigrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_voucher_tables_match_the_schema_and_keep_item_id_polymorphic(): void
    {
        $this->assertTrue(Schema::hasColumns('vouchers', [
            'id',
            'maximum_discount',
            'discount',
            'is_usable',
            'valid_from',
            'valid_until',
            'max_redem',
            'created_at',
            'updated_at',
            'created_by',
        ]));

        $this->assertTrue(Schema::hasColumns('associated_voucher', [
            'voucher_id',
            'item_id',
            'item_type',
        ]));

        $this->assertTrue(Schema::hasColumns('subscription_payments', [
            'subamount',
            'voucher_id',
            'total_amount',
        ]));

        $columns = DB::select('PRAGMA table_info(associated_voucher)');
        $primaryKeyColumns = collect($columns)
            ->filter(fn (object $column): bool => $column->pk > 0)
            ->sortBy('pk')
            ->pluck('name')
            ->values()
            ->all();

        $this->assertSame(['voucher_id', 'item_id', 'item_type'], $primaryKeyColumns);

        $foreignKeys = DB::select('PRAGMA foreign_key_list(associated_voucher)');

        $this->assertCount(1, $foreignKeys);
        $this->assertSame('voucher_id', $foreignKeys[0]->from);
        $this->assertSame('vouchers', $foreignKeys[0]->table);
        $this->assertSame('id', $foreignKeys[0]->to);
    }
}

<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $primaryKey = 'produk_id';
    protected $table = 'table_produk';

    protected $fillable = [
        'nama_produk',
        'kategori',
        'tgl_masuk',
        'tgl_expired',
        'Mitra',
        'gambar',
        ];
        public function scopeFilter(Builder $query, $request, array $filterableColumns, array $searchableColumns): Builder
        {
            foreach ($filterableColumns as $column) {
                if ($request->filled($column)) {
                    $query->where($column, $request->input($column));
                }
            }
            if ($request->filled('search')) {
                $query->where(function ($q) use ($request, $searchableColumns) {
                    foreach ($searchableColumns as $column) {
                        $q->orWhere($column, 'LIKE', '%' . $request->input('search') . '%');
                    }
                });
            }
            return $query;
        }
}

<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Barang([
            'nama_barang'    => $row['nama_barang'],
            'kd_akun'        => $row['kd_akun'],
            'kode_log'       => $row['kode_log'],
            'jumlah'         => $row['jumlah'],
            'satuan'         => $row['satuan'],
            'harga'          => $row['harga'],
            'total'          => $row['total'],
            'rak'            => $row['rak'],
            'tanggal'        => Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d'),
            'jumlah_minimal' => $row['jumlah_minimal'],
            'jumlah_maksimal' => $row['jumlah_maksimal'],
            'no_katalog'     => $row['no_katalog'],
            'merk'           => $row['merk'],
            'no_akun'        => $row['no_akun'],
            'no_reff'        => $row['no_reff'],
        ]);
    }
}

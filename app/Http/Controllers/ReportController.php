<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\Orders;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use App\Models\KodeInstitusi;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReportController extends Controller
{
    public function kondisistock(Request $request)
    {
        Log::info('KondisiStock method started.');

        $search = $request->input('search');
        Log::info('Search term:', ['search' => $search]);

        $institusi = KodeInstitusi::all();
        $unitkerja = UnitKerja::all();
        $orders = Orders::where('order_status', '!=', 'Finished')->get();

        Log::info('Supporting data retrieved', [
            'institusi_count' => $institusi->count(),
            'unitkerja_count' => $unitkerja->count(),
            'orders_count' => $orders->count(),
        ]);

        // Get the authenticated user's kd_prod
        $user = auth()->user();
        $userPlant = $user->plant;
        $userRole = $user->role; // Assuming 'role' is a property on the User model
        Log::info('Authenticated user plant and role:', ['plant' => $userPlant, 'role' => $userRole]);

        // Filter barangs based on matching kode_log and kd_prod
        $barangs = barang::query()
        ->when(!in_array($userRole, ['superadmin', 'viewer']), function ($query) use ($userPlant) {
            $query->whereHas('logGudang', function ($query) use ($userPlant) {
                $query->where('kd_prod', $userPlant)
                    ->whereColumn('kd_log', 'barangs.kode_log'); // Ensure matching kode_log
            });
        })
            ->where(function ($query) use ($search) {
                $query->where('no_barcode', 'like', "%{$search}%")
                    ->orWhere('no_item', 'like', "%{$search}%")
                    ->orWhere('nama_barang', 'like', "%{$search}%")
                    ->orWhere('kode_log', 'like', "%{$search}%")
                    ->orWhere('kd_unit', 'like', "%{$search}%")
                    ->orWhere('kd_akun', 'like', "%{$search}%")
                    ->orWhere('jumlah', 'like', "%{$search}%")
                    ->orWhere('satuan', 'like', "%{$search}%")
                    ->orWhere('harga', 'like', "%{$search}%")
                    ->orWhere('rak', 'like', "%{$search}%")
                    ->orWhere('total', 'like', "%{$search}%")
                    ->orWhere('tanggal', 'like', "%{$search}%")
                    ->orWhere('jumlah_minimal', 'like', "%{$search}%")
                    ->orWhere('jumlah_maksimal', 'like', "%{$search}%")
                    ->orWhere('no_katalog', 'like', "%{$search}%")
                    ->orWhere('merk', 'like', "%{$search}%")
                    ->orWhere('no_akun', 'like', "%{$search}%")
                    ->orWhere('no_reff', 'like', "%{$search}%");
            })
            ->get();

        Log::info('Filtered barangs retrieved', ['barangs_count' => $barangs->count()]);

        foreach ($barangs as $barang) {
            $barang->qr_code = base64_encode(QrCode::format('svg')->size(100)->generate($barang->no_barcode));
            Log::info('QR code generated for barang', ['barang_id' => $barang->id]);
        }

        Log::info('Index method finished.');

        return view('report.kondisistock', compact('barangs', 'orders', 'institusi', 'unitkerja'));
    }

}

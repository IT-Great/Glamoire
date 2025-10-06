<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\AffiliateResponseMail;
use App\Models\Partner;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\File;


class AffiliateController extends Controller
{
    public function indexAffiliateAdmin()
    {
        $partners = Partner::orderBy('created_at', 'desc')->get();

        return view('admin.affiliate.index', compact('partners'));
    }

    public function detailAffiliateAdmin($id)
    {
        $partners = Partner::findOrFail($id);
        return view('admin.affiliate.detail', compact('partners'));
    }


    public function sendResponseAffiliate(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|min:10'
        ]);

        $partners = Partner::findOrFail($id);

        try {
            Log::info('Attempting to send email to: ' . $partners->email);

            Mail::to($partners->email)
                ->send(new AffiliateResponseMail($partners, $request->response));

            Log::info('Email sent successfully to: ' . $partners->email);

            $partners->update([
                'response' => $request->response,
                'responded_at' => now()
            ]);

            return redirect()->route('index-affiliate-admin')
                ->with('success', 'Response has been sent successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return redirect()
                ->back()
                ->with('toast_error', 'Failed to send response: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function deleteAffiliate($id)
    {
        try {
            // Cari partner berdasarkan ID
            $partner = Partner::find($id);

            if (!$partner) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data mitra tidak ditemukan.'
                ], 404);
            }

            // Cari file perusahaan yang terkait
            if ($partner->file_company) {
                $file = File::find($partner->file_company);

                if ($file) {
                    // Hapus file fisik dari storage jika masih ada
                    if (Storage::disk('public')->exists($file->file_path)) {
                        Storage::disk('public')->delete($file->file_path);
                    }

                    // Hapus record file dari database
                    $file->delete();
                }
            }

            // Hapus data partner dari database
            $partner->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data mitra dan file perusahaan berhasil dihapus.'
            ]);
        } catch (\Exception $err) {
            Log::error('Gagal menghapus mitra: ' . $err->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data mitra.'
            ], 500);
        }
    }
}

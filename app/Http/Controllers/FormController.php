<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

use App\Mail\sendMailCodeNewUser;
use App\Models\User;
use App\Models\Subscribe;
use App\Models\Question;
use App\Models\Partner;
use App\Models\VoucherNewUser;
use App\Models\File;
use Exception;

class FormController extends Controller
{
    public function checkEmailSubscribe(Request $request)
    {
        $emailExists = Subscribe::where('email', $request->email)->exists();

        return response()->json(['exists' => $emailExists]);
    }

    public function checkEmailVoucher(Request $request)
    {

        $emailExists = User::where('email', $request->email)->exists();
        $voucherExists = VoucherNewUser::where('email', $request->email)->exists();

        return response()->json(['exists' => $emailExists]);
    }

    // public function sendQuestion(Request $request)
    // {
    //     try { 
    //         $question = Question::create([
    //             'fullname'   => $request->fullname,
    //             'email'      => $request->email,
    //             'question'   => $request->question,
    //             'created_at' => now(),
    //         ]);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Pertanyaan Anda Sudah Kami Terima. 
    //             Tunggu Balasan Email Dari Kami Yaa'
    //         ]);
    //     } catch (Exception $err) {
    //         dd($err);
    //     }
    // }

    public function sendQuestion(Request $request)
    {
        try {
            $request->validate([
                'fullname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'question' => 'required|string',
                'upload.*' => 'file|mimes:jpeg,png,jpg,mp4|max:5120', // Max 5MB per file
            ]);

            $imagePaths = [];
            $videoPath = null;

            // dd($request->file('upload'));

            if ($request->file('upload')) {
                foreach ($request->file('upload') as $file) {
                    if ($file instanceof \Illuminate\Http\UploadedFile) {
                        $mimeType = $file->getMimeType();
                        $fileName = time() . '_' . $file->getClientOriginalName();

                        if (strpos($mimeType, 'image/') === 0) {
                            $imagePath = $file->storeAs('contact_us_images', $fileName, 'public');
                            $imagePaths[] = $imagePath;
                        } elseif (strpos($mimeType, 'video/') === 0) {
                            $videoPath = $file->storeAs('contact_us_videos', $fileName, 'public');
                        }
                    }
                }
            }

            // dd($videoPath);
            $dataToSave = [
                'fullname' => $request->fullname,
                'email' => $request->email,
                'question' => $request->question,
                'images' => !empty($imagePaths) ? json_encode($imagePaths) : null,
                'videos' => $videoPath,
                'created_at' => now(),
            ];

            Log::info('Saving data:', $dataToSave);

            Question::create($dataToSave);

            // return view('user.component.contact');
             return response()->json([
                'success' => true,
                'message' => 'Pertanyaan Anda Sudah Kami Terima. 
                Tunggu Balasan Email Dari Kami Yaa'
            ]);
        } catch (\Exception $err) {
            Log::error('Error saving question:', ['error' => $err->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan pertanyaan',
                'error' => $err->getMessage()
            ], 500);
        }
    }


    public function files(Request $request)
    {
        try {
            if ($request->hasFile('file_company')) {
                // Simpan file ke direktori penyimpanan
                $fileCompany = $request->file('file_company');
                $fileCompanyName = time() . '_' . $fileCompany->getClientOriginalName();
                $fileCompanyPath = $fileCompany->storeAs('uploads', $fileCompanyName, 'public'); // Menyimpan di storage/app/public/uploads

                // Simpan informasi file di database
                $companyFile = File::create([
                    'file_name' => $fileCompanyName,
                    'file_path' => $fileCompanyPath,
                    'type' => 'company', // Pastikan type diisi
                ]);
            }

            if ($request->hasFile('file_bpom')) {
                // Simpan file ke direktori penyimpanan
                $fileBpom = $request->file('file_bpom');
                $fileBpomName = time() . '_' . $fileBpom->getClientOriginalName();
                $fileBpomPath = $fileBpom->storeAs('uploads', $fileBpomName, 'public'); // Menyimpan di storage/app/public/uploads

                // Simpan informasi file di database
                $bpomFile = File::create([
                    'file_name' => $fileBpomName,
                    'file_path' => $fileBpomPath,
                    'type' => 'bpom', // Pastikan type diisi
                ]);
            }

            Partner::create([
                'fullname'          => $request->partner_fullname,
                'handphone'         => $request->partner_handphone,
                'email'             => $request->partner_email,
                'company_name'      => $request->company,
                'description'       => $request->description,
                'bpom'              => $request->bpom == "yes" ? TRUE : FALSE,
                'distributor'       => $request->distributor == "yes" ? TRUE : FALSE,
                'reached_email'     => $request->receive_email == "yes" ? TRUE : FALSE,
                'category_product'  => $request->category_product,
                'file_company'      => isset($companyFile) ? $companyFile->id : null,
                'file_bpom'         => isset($bpomFile) ? $bpomFile->id : null,
            ]);

            session()->flash('send_success');
            return redirect()->back()->with('success', 'File berhasil diupload');
        } catch (Exception $err) {
            dd($err);
        }
    }

    public function comment(Request $request)
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Komentar Berhasil Ditambahkan'
            ]);
        } catch (Exception $err) {
            dd($err);
        }
    }

    public function voucherNewUser(Request $request)
    {
        $check = VoucherNewUser::where('email', $request->email)->exists();

        // Buat voucher hanya jika email belum terdaftar
        if (!$check) {
            $increment = VoucherNewUser::count() + 1;

            // Ambil 4 karakter pertama dari ID user
            $idFragment = substr($request->email, 0, 4);

            // Buat kode voucher sesuai format "increment-4hurufID"
            $codeUser = "{$increment}-{$idFragment}";

            VoucherNewUser::create([
                'code' => $codeUser,
                'email' => $request->email,
                'is_use' => 0,
            ]);

            $data = [
                'code' => $codeUser,
                'fullname' => "Calon pengguna",
            ];

            $email_target = $request->email;

            Mail::to($email_target)->send(new sendMailCodeNewUser($data));

            return response()->json([
                'success' => true,
                'message' => 'Silakan cek email kamu untuk melihat voucher yang kamu dapat'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Email anda sudah terdaftar.'
            ]);
        }
    }
}

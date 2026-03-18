<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use ZipArchive;
use App\Models\DataLab;

class FileDownloadController extends Controller
{
    public function DataLabBatchDownload($id)
    {
        $dataLab = DataLab::findOrFail($id);

        // Pastikan images selalu array
        $filesToDownload = (array) $dataLab->images;

        // Jika hanya 1 file → download langsung
        if (count($filesToDownload) === 1) {

            $file = str_replace('|', '/', $filesToDownload[0]);

            if (Storage::disk('public')->exists($file)) {
                return Storage::disk('public')->download(
                    $file,
                    'data-lab_' . $dataLab->patient->full_name . '.jpg'
                );
            }

            if (Storage::disk('local')->exists($file)) {
                return Storage::disk('local')->download(
                    $file,
                    'data-lab_' . $dataLab->patient->full_name . '.jpg'
                );
            }

            abort(404, 'File tidak ditemukan.');
        }

        // Buat folder zip jika belum ada
        $zipFolder = storage_path('app/public/data-lab');

        if (!file_exists($zipFolder)) {
            mkdir($zipFolder, 0755, true);
        }

        // Nama zip
        $zipFileName = 'data-lab-' . $dataLab->patient->full_name . '-' . time() . '.zip';
        $zipFilePath = $zipFolder . '/' . $zipFileName;

        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {

            foreach ($filesToDownload as $k => $file) {

                $file = str_replace('|', '/', $file);
                $no = $k + 1;

                // cek di disk public
                if (Storage::disk('public')->exists($file)) {

                    $absolutePath = Storage::disk('public')->path($file);

                    $zip->addFile(
                        $absolutePath,
                        'data-lab-' . $dataLab->patient->full_name . '-' . $no . '.jpg'
                    );
                }

                // cek di disk local
                elseif (Storage::disk('local')->exists($file)) {

                    $absolutePath = Storage::disk('local')->path($file);

                    $zip->addFile(
                        $absolutePath,
                        'data-lab-' . $dataLab->patient->full_name . '-' . $no . '.jpg'
                    );
                }
            }

            $zip->close();
        }

        // Download zip
        if (file_exists($zipFilePath)) {

            return Response::download($zipFilePath, $zipFileName)
                ->deleteFileAfterSend(true);
        }

        return back()->withErrors([
            'error' => 'Tidak dapat membuat file zip.'
        ]);
    }

    public function DataLabPreview($path)
    {
        $path = str_replace('|', '/', $path);

        // cek public
        if (Storage::disk('public')->exists($path)) {
            return response()->file(Storage::disk('public')->path($path));
        }

        // cek local
        if (Storage::disk('local')->exists($path)) {
            return response()->file(Storage::disk('local')->path($path));
        }

        abort(404, 'File tidak ditemukan.');
    }
}

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
        // 1. Define the files you want to include in the batch download
        // These paths should be relative to the 'storage/app' directory
        $dataLab = DataLab::find($id);
        $filesToDownload = $dataLab->images;

        if (sizeof($filesToDownload) == 1) {
            $p = str_replace('|', '/', $filesToDownload[0]);
            if (Storage::disk('local')->exists($p)) {
                return Storage::disk('local')->download($p, 'data-lab_' . $dataLab->patient->full_name . '.jpg');
            } else if (Storage::disk('public')->exists($p)) {
                return Storage::disk('public')->download($p, 'data-lab_' . $dataLab->patient->full_name . '.jpg');
            }
        }
        // 2. Define the name and path for the temporary zip file in storage
        $zipFileName = 'data-lab-' . $dataLab->patient->full_name . '-' . time() . '.zip';
        $zipFilePath = storage_path('app/public/data-lab/' . $zipFileName);

        // 3. Initialize ZipArchive
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($filesToDownload as $k => $file) {
                // Check if the file exists in storage before adding
                if (Storage::disk('local')->exists($file)) {
                    // Get the absolute path of the file
                    $no = $k + 1;
                    $absolutePath = storage_path('app/private/' . $file);
                    // Add the file to the zip archive with its base name
                    $zip->addFile($absolutePath, 'data-lab-' . $dataLab->patient->full_name . '-' . $no . '.jpg');
                }
                if (Storage::disk('public')->exists($file)) {
                    // Get the absolute path of the file
                    $absolutePath = storage_path('app/public/' . $file);
                    // Add the file to the zip archive with its base name
                    $zip->addFile($absolutePath, 'data-lab-' . $dataLab->patient->full_name . '-' . $no . '.jpg');
                }
            }
            $zip->close();
        }

        // 4. Return the zip file as a download response
        if (file_exists($zipFilePath)) {
            // Initiate the download and set a friendly download name for the user
            return Response::download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
        }

        return back()->withErrors(['error' => 'Could not create batch download zip file.']);
    }

    public function DataLabPreview($path)
    {
        $path = str_replace('|', '/', $path);

        $absolutePath = storage_path('app/private/' . $path);

        if (! file_exists($absolutePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->file($absolutePath);
    }
}

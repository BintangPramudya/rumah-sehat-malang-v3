use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    public function makePublic($fileName)
    {
        // Define the old and new paths relative to their respective disk roots
        $oldPath = 'private_files/' . $fileName; // e.g., in storage/app/private_files
        $newPath = 'public_files/' . $fileName; // e.g., in storage/app/public/public_files

        // Check if the file exists in the private disk
        if (Storage::disk('local')->exists($oldPath)) {
            // Move the file from the 'local' (private) disk to the 'public' disk
            Storage::disk('local')->move($oldPath, 'public/' . $newPath);

            // Note: The second parameter 'public/...' automatically targets 
            // the 'public' disk's root path if you are using the default 'local' disk in the first parameter. 
            // A more explicit way is to use disk() for both:
            // Storage::disk('local')->move($oldPath, Storage::disk('public')->path($newPath)); 
            
            return redirect()->back()->with('success', 'File moved to public storage successfully.');
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TaskAttachment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskAttachmentController extends Controller
{
    use AuthorizesRequests;

    public function download(TaskAttachment $attachment)
    {
        $this->authorize('view', $attachment->task);
        
        return Storage::disk('public')->download($attachment->path, $attachment->filename);
    }

    public function destroy(TaskAttachment $attachment)
    {
        $this->authorize('update', $attachment->task);
        
        Storage::disk('public')->delete($attachment->path);
        
        $attachment->delete();
        
        return redirect()->back()->with('success', 'Attachment deleted successfully');
    }
}

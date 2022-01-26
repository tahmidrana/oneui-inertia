<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function destroy(Attachment $attachment)
    {
        try {
            Storage::delete($attachment->path);
            $attachment->delete();
            return back()->withSuccess('Attachment deleted successfully');
        } catch (Exception $e) {
            return back()->withError('Attachment delete failed');
        }
    }
}

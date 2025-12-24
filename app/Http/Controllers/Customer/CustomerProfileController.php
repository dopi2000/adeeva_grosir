<?php

namespace App\Http\Controllers\Customer;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CustomerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Profile Saya | Adeeva Sandal Grosir';
        return view('customers.dashboard.profile-customer',['title' => $title]);
    }

    public function uploadAvatar(Request $request) {
        if($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('tmp', 'public');
            return $path;
        }
        return response('File tidak ada', 404);
    }

    public function cancelUploadAvatar(Request $request) {
        $path = $request->getContent();
        if(Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return response('', 200);
        }
        return response('File tidak ditemukan', 400);
    }

  }

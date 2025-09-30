<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    // Display all documents (with search)
    public function index(Request $request)
    {
        $query = Document::query();
        if ($request->has('search')) {
            $query->where('original_name', 'like', '%'.$request->search.'%');
        }
        $user = Auth::user();
        if ($user && $user->role === 'admin') {
            $documents = $query->with('user')->get();
        } else {
            $documents = $query->with('user')->where('user_id', $user->id)->get();
        }
        // Tambahkan status: 'Rahasia' jika terenkripsi, 'Umum' jika tidak
        foreach ($documents as $doc) {
            $doc->status_label = $doc->encrypted ? 'Rahasia' : 'Umum';
        }
        return view('documents.index', compact('documents'));
    }

    // Admin: lihat semua dokumen dari semua user
    public function adminIndex()
    {
        // Ambil dokumen beserta user, lalu kelompokkan berdasarkan user
        $documentsByUser = Document::with('user')->get()->groupBy(function($doc) {
            return $doc->user ? $doc->user->name : 'Tanpa User';
        });
        return view('admin.documents', [
            'documentsByUser' => $documentsByUser
        ]);
    }

    // Show upload form
    public function create()
    {
        return view('documents.create');
    }

    // Store uploaded file with encryption
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'encrypt' => 'required',
        ]);
        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $filename = Str::random(40);
        $content = file_get_contents($file->getRealPath());
        $isEncrypted = $request->input('encrypt') == '1';
        if ($isEncrypted) {
            $request->validate(['key' => 'required|string|min:6']);
            $key = $request->input('key');
            $encryptedContent = openssl_encrypt($content, 'AES-256-CBC', $key, 0, substr(hash('sha256', $key), 0, 16));
            Storage::put('private/'.$filename, $encryptedContent);
            $masterKey = env('APP_KEY');
            $recoveryKey = openssl_encrypt($key, 'AES-256-CBC', $masterKey, 0, substr(hash('sha256', $masterKey), 0, 16));
            Document::create([
                'user_id' => Auth::id(),
                'filename' => $filename,
                'original_name' => $originalName,
                'encrypted' => true,
                'encryption_key_hash' => bcrypt($key),
                'recovery_key' => $recoveryKey,
            ]);
        } else {
            Storage::put('private/'.$filename, $content);
            Document::create([
                'user_id' => Auth::id(),
                'filename' => $filename,
                'original_name' => $originalName,
                'encrypted' => false,
                'encryption_key_hash' => null,
                'recovery_key' => null,
            ]);
        }
        return redirect()->route('documents.index')->with('success', 'File uploaded!');
    }

    // Show file list (unencrypted & encrypted)
    public function show($id)
    {
        $doc = Document::findOrFail($id);
        return view('documents.show', compact('doc'));
    }

    // Download & decrypt file
    public function download(Request $request, $id)
    {
        $doc = Document::findOrFail($id);
        if (!$doc->encrypted) {
            $content = Storage::get('private/'.$doc->filename);
            return response($content)
                ->header('Content-Type', 'application/octet-stream')
                ->header('Content-Disposition', 'attachment; filename="'.$doc->original_name.'"');
        }
        $request->validate(['key' => 'required|string']);
        if (!password_verify($request->key, $doc->encryption_key_hash)) {
            return back()->withErrors(['key' => 'Kunci salah!']);
        }
        $encryptedContent = Storage::get('private/'.$doc->filename);
        $decrypted = openssl_decrypt($encryptedContent, 'AES-256-CBC', $request->key, 0, substr(hash('sha256', $request->key), 0, 16));
        return response($decrypted)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', 'attachment; filename="'.$doc->original_name.'"');
    }

    // Download raw encrypted file
    public function downloadEncrypted($id)
    {
        $doc = Document::findOrFail($id);
        if (!$doc->encrypted) {
            return back()->withErrors(['msg' => 'File belum terenkripsi.']);
        }
        $encryptedContent = Storage::get('private/'.$doc->filename);
        return response($encryptedContent)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', 'attachment; filename="ENCRYPTED_'.$doc->original_name.'"');
    }

    // CRUD: edit, update, destroy
    public function edit($id)
    {
        $doc = Document::findOrFail($id);
        return view('documents.edit', compact('doc'));
    }
    public function update(Request $request, $id)
    {
        $doc = Document::findOrFail($id);
        $doc->update($request->only(['description', 'original_name']));
        return redirect()->route('documents.index')->with('success', 'Updated!');
    }
    public function destroy($id)
    {
        $doc = Document::findOrFail($id);
        Storage::delete('private/'.$doc->filename);
        $doc->delete();
        return redirect()->route('documents.index')->with('success', 'Deleted!');
    }

    // View only encrypted documents
    public function encrypted(Request $request)
    {
        $query = Document::query();
        if ($request->has('search')) {
            $query->where('original_name', 'like', '%'.$request->search.'%');
        }
        $documents = $query->where('user_id', Auth::id())
            ->where('encrypted', true)
            ->get();
        return view('documents.encrypted', compact('documents'));
    }
}

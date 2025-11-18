<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BannerController extends Controller
{
    private $apiUrl;
    private $imgUrl;
    public function __construct()
    {
        $this->apiUrl = config('services.api_service.url');
        $this->imgUrl = config('services.api_image.url');
    }

    public function index()
    {
        $response = Http::get("{$this->apiUrl}/banners");
        // dd(config('services.api_image.url'));

        if ($response->successful()) {
            $banners = $response->json()['data'] ?? $response->json();
            $banners = array_map(function ($banner) {
                if (!empty($banner['image'])) {
                    $banner['image'] = $this->imgUrl . '/' . 'storage/' . $banner['image'];
                }
                return $banner;
            }, $banners);
        } else {
            $banners = [];
        }

        $responseOptions = Http::get("{$this->apiUrl}/banner-options");
        if ($responseOptions->successful()) {
            $options = $responseOptions->json()['status'] ?? ['active', 'non-active'];
        } else {
            $options = ['active', 'non-active'];
        }

        return view('admin.banner', compact('banners', 'options'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'status' => 'required|in:active,non-active',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'description.required' => 'Deskripsi wajib diisi.',
                'status.required' => 'Status wajib dipilih.',
                'image.required' => 'Gambar wajib diupload.',
                'image.mimes' => 'Format gambar tidak valid.',
                'image.max' => 'Ukuran gambar maksimal 2MB.',
            ]
        );

        $httpRequest = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ]);

        if ($request->hasFile('image')) {
            $httpRequest = $httpRequest->attach(
                'image',
                file_get_contents($request->file('image')->getRealPath()),
                $request->file('image')->getClientOriginalName()
            );
        }

        $response = $httpRequest->post("{$this->apiUrl}/banners", [
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        // dd($response->body());

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Banner berhasil ditambahkan!');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan banner.');
    }

    public function update(Request $request, $id)
    {
        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:active,non-active',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // HTTP client dengan header token
        $http = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->asMultipart(); // Penting agar bisa kirim file

        // Jika ada gambar, attach file
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $http = $http->attach(
                'image',
                file_get_contents($file->getRealPath()),
                $filename
            );
        }

        // Kirim data lainnya sekaligus
        $response = $http->post("{$this->apiUrl}/banners/{$id}", [
            '_method' => 'PUT', // karena update pakai PUT
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        // Debug response
        // dd($response->json());

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Banner berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui banner.');
    }

    public function destroy($id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->delete("{$this->apiUrl}/banners/{$id}");

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Banner berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Gagal menghapus banner.');
    }
}

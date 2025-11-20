<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GalleryController extends Controller
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
        $response = Http::get("{$this->apiUrl}/galleries");

        if ($response->successful()) {
            $galleries = $response->json()['data'] ?? $response->json();
            $galleries = array_map(function ($gallery) {
                if (!empty($gallery['image'])) {
                    $gallery['image'] = $this->imgUrl . '/' . 'storage/' . $gallery['image'];
                }
                return $gallery;
            }, $galleries);
        } else {
            $galleries = [];
        }

        $categories = Http::get("{$this->apiUrl}/category-gallery")->json()['data'] ?? [];

        return view('admin.gallery', compact('galleries', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_gallery_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'category_gallery_id.required' => 'Kategori wajib dipilih.',
            'image.required' => 'Gambar wajib diupload.',
            'image.mimes' => 'Format gambar tidak valid.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // dd($request->all());

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

        $response = $httpRequest->post("{$this->apiUrl}/galleries", [
            'name' => $request->name,
            'description' => $request->description,
            'category_gallery_id' => $request->category_gallery_id,
        ]);
        // dd($response->body());
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Gallery berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Gallery gagal ditambahkan!');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_gallery_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'category_gallery_id.required' => 'Kategori wajib dipilih.',
            'image.required' => 'Gambar wajib diupload.',
            'image.mimes' => 'Format gambar tidak valid.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $httpRequest = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ]);

        // Kirim file jika ada
        if ($request->hasFile('image')) {
            $httpRequest = $httpRequest->attach(
                'image',
                file_get_contents($request->file('image')->getRealPath()),
                $request->file('image')->getClientOriginalName()
            );
        }

        // PENTING: Gunakan POST + _method PUT
        $response = $httpRequest->post("{$this->apiUrl}/galleries/{$id}", [
            '_method' => 'PUT',
            'name' => $request->name,
            'description' => $request->description,
            'category_gallery_id' => $request->category_gallery_id,
        ]);

        // dd($response->json());

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Gallery berhasil diupdate!');
        } else {
            return redirect()->back()->with('error', 'Gallery gagal diupdate!');
        }
    }

    public function destroy($id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->delete("{$this->apiUrl}/galleries/{$id}");
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Gallery berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus gallery.');
        }
    }
}

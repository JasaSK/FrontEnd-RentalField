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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:active,non-active',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

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

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Banner berhasil ditambahkan!');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan banner.');
    }
}

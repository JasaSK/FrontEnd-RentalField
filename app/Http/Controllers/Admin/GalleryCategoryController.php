<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class GalleryCategoryController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl  = config('services.api_service.url');
    }

    public function index()
    {
        $response = Http::get("{$this->apiUrl}/category-gallery");
       // dd($response);
        if ($response->successful()) {
            $categories = $response->json()['data'] ?? [];
            // dd($categories);
        } else {
            $categories = [];
        }
        return view('admin.gallery-category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
        ]);
        // dd($request->all());
        $httpRequest = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ]);

        $response =  $httpRequest->post("{$this->apiUrl}/category-gallery", [
            'name' => $request->name,
        ]);
        // dd($response);
        // dd($response->body());

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Category created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create category.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
        ]);

        $httpRequest = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ]);

        $response =  $httpRequest->put("{$this->apiUrl}/category-gallery/{$id}", [
            'name' => $request->name,
        ]);
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Category updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update category.');
        }
    }

    public function destroy($id)
    {
        $httpRequest = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ]);
        $response =  $httpRequest->delete("{$this->apiUrl}/category-gallery/{$id}");
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete category.');
        }
    }
}

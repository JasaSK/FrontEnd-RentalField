<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FieldController extends Controller
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
        $response = Http::get("{$this->apiUrl}/fields");
        if ($response->successful()) {
            $fields = $response->json()['data'] ?? $response->json();
            $fields = array_map(function ($field) {
                if (!empty($field['image'])) {
                    $field['image'] = $this->imgUrl . '/' . 'storage/' . $field['image'];
                }
                return $field;
            }, $fields);
        } else {
            $fields = [];
        }

        $categories = Http::get("{$this->apiUrl}/category-fields")->json()['data'] ?? [];

        return view('admin.field', compact('fields', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'category_field_id' => 'required|numeric',
            'open_time'         => 'required',
            'close_time'        => 'required',
            'description'       => 'required|string',
            'category_field_id' => 'required|integer',
            'status'            => 'required|string|max:255',
            'price_per_hour'    => 'required|numeric',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ], [
            'name.required'              => 'Nama wajib diisi.',
            'category_field_id.required' => 'Kategori wajib dipilih.',
            'category_field_id.numeric'  => 'Kategori tidak valid.',

            'open_time.required'         => 'Jam buka wajib diisi.',
            'close_time.required'        => 'Jam tutup wajib diisi.',

            'description.required'       => 'Deskripsi wajib diisi.',

            'status.required'            => 'Status wajib dipilih.',

            'price_per_hour.required'    => 'Harga per jam wajib diisi.',
            'price_per_hour.numeric'     => 'Harga per jam harus berupa angka.',

            'image.image'                => 'File harus berupa gambar.',
            'image.mimes'                => 'Format gambar hanya boleh JPG, JPEG, atau PNG.',
            'image.max'                  => 'Ukuran gambar maksimal 2MB.',
        ]);

        // dd($request->all());
        // dd($request->category_field_id);


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

        $response = $httpRequest->post("{$this->apiUrl}/fields", [
            'name' => $request->name,
            'description' => $request->description,
            'price_per_hour' => $request->price_per_hour,
            'category_field_id' => $request->category_field_id,
            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
            'status' => $request->status,
        ]);
        // dd($response->body());

        if ($response->successful()) {
            return redirect()->route('admin.fields')->with('success', 'Field berhasil ditambahkan.');
        } else {
            return redirect()->back()->withErrors('Gagal menambahkan field. Silakan coba lagi.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'category_field_id' => 'required|numeric',
            'open_time'         => 'required',
            'close_time'        => 'required',
            'description'       => 'required|string',
            'category_field_id' => 'required|integer',
            'status'            => 'required|string|max:255',
            'price_per_hour'    => 'required|numeric',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ], [
            'name.required'              => 'Nama wajib diisi.',
            'category_field_id.required' => 'Kategori wajib dipilih.',
            'category_field_id.numeric'  => 'Kategori tidak valid.',

            'open_time.required'         => 'Jam buka wajib diisi.',
            'close_time.required'        => 'Jam tutup wajib diisi.',

            'description.required'       => 'Deskripsi wajib diisi.',

            'status.required'            => 'Status wajib dipilih.',

            'price_per_hour.required'    => 'Harga per jam wajib diisi.',
            'price_per_hour.numeric'     => 'Harga per jam harus berupa angka.',

            'image.image'                => 'File harus berupa gambar.',
            'image.mimes'                => 'Format gambar hanya boleh JPG, JPEG, atau PNG.',
            'image.max'                  => 'Ukuran gambar maksimal 2MB.',
        ]);


        // dd($request->all());
        $httpRequest = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
            'Accept' => 'application/json',
        ]);

        $data = [
            '_method' => 'PUT',
            'name' => $request->name,
            'description' => $request->description,
            'price_per_hour' => $request->price_per_hour,
            'category_field_id' => $request->category_field_id,
            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
            'status' => $request->status,
        ];

        if ($request->hasFile('image')) {
            $response = $httpRequest
                ->attach(
                    'image',
                    file_get_contents($request->file('image')->getRealPath()),
                    $request->file('image')->getClientOriginalName()
                )
                ->post("{$this->apiUrl}/fields/{$id}", $data);
        } else {
            $response = $httpRequest->put("{$this->apiUrl}/fields/{$id}", $data);
        }

        if ($response->successful()) {
            return redirect()->route('admin.fields')->with('success', 'Field berhasil diperbarui.');
        } else {
            return redirect()->back()->withErrors('Gagal memperbarui field. Silakan coba lagi.');
        }
    }


    public function destroy($id)
    {
        $httpRequest = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token')
        ]);
        $response = $httpRequest->delete("{$this->apiUrl}/fields/{$id}");
        if ($response->successful()) {
            return redirect()->route('admin.fields')->with('success', 'Field berhasil dihapus.');
        } else {
            return redirect()->back()->withErrors('Gagal menghapus field. Silakan coba lagi.');
        }
    }
}

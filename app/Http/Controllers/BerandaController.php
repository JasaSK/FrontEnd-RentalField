<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BerandaController extends Controller
{
    private $apiUrl;
    private $imgUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api_service.url');
        $this->imgUrl = config('services.api_image.url');
    }

    public function index(Request $request)
    {
        $data = $this->getDefaultData();

        $params = [
            'tanggal_main'       => $request->input('tanggal_main'),
            'open_time'          => $request->input('open_time'),
            'close_time'         => $request->input('close_time'),
            'category_field_id'  => $request->input('category_field_id'),
        ];
        $params = array_filter($params);

        $fieldsResponse = Http::get("{$this->apiUrl}/fields", $params);
        $fields = $fieldsResponse->successful() ? $fieldsResponse->json()['data'] ?? [] : [];

        $fields = $this->mapImages($fields);

        $showAll = $request->get('show') === 'all';
        $limit = $showAll ? count($fields) : 4;

        $fieldsLimited = array_slice($fields, 0, $limit);

        $data['fields'] = $fieldsLimited;
        $data['totalFields'] = count($fields);
        $data['limit'] = $limit;
        $data['isSearch'] = !empty($params);
        $data['showAll'] = $showAll;
        $data['request'] = $request->all();


        return view('beranda.index', $data);
    }

    public function search(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal_main' => 'nullable|date',
            'open_time' => 'nullable|string',
            'close_time' => 'nullable|string',
            'category_field_id' => 'nullable|numeric',
        ]);

        // Set tanggal default jika tidak diisi
        $tanggalMain = $request->input('tanggal_main', now()->toDateString());

        // Panggil endpoint search BE
        $response = Http::post("{$this->apiUrl}/fields/search", [
            'tanggal_main'      => $tanggalMain,
            'open_time'         => $request->input('open_time'),
            'close_time'        => $request->input('close_time'),
            'category_field_id' => $request->input('category_field_id'),
        ]);

        $fields = [];
        if ($response->successful()) {
            $fields = $this->mapImages($response->json()['data'] ?? []);
        }

        // Simpan ke session untuk ditampilkan di searchResult
        session()->put('search_results', $fields);
        session()->put('search_params', $request->only([
            'tanggal_main',
            'open_time',
            'close_time',
            'category_field_id'
        ]));

        // Redirect ke halaman result
        return redirect()->route('beranda.search.result');
    }

    public function searchResult(Request $request)
    {
        $allFields = session('search_results', []);
        $params = session('search_params', []);

        // cek apakah user klik "Lihat Semua"
        $showAll = $request->query('show') === 'all';

        // Default limit = 4, tapi kalau show=all → tampilkan semua
        $limit = $showAll ? count($allFields) : 4;

        // Ambil data sesuai limit
        $fields = array_slice($allFields, 0, $limit);

        $data = $this->getDefaultData();
        $data['fields'] = $fields;
        $data['totalFields'] = count($allFields);
        $data['limit'] = $limit;
        $data['isSearch'] = true;
        $data['showAll'] = $showAll;
        $data['request'] = $params;

        return view('beranda.index', $data);
    }
    private function getDefaultData()
    {
        $categoriesFields = Http::get("{$this->apiUrl}/category-fields")->json()['data'] ?? [];
        $categoriesGalleries = Http::get("{$this->apiUrl}/category-gallery")->json()['data'] ?? [];

        $galleriesResponse = Http::get("{$this->apiUrl}/galleries")->json()['data'] ?? [];
        $bannersResponse = Http::get("{$this->apiUrl}/banners")->json()['data'] ?? [];

        // FIX: mapping gallery tidak tumpang tindih
        $galleries = array_map(function ($g) {
            return [
                'image' => $this->imgUrl . '/storage/' . ($g['image'] ?? ''),
                'category_gallery' => $g['category_gallery'] ?? ['name' => 'unknown'],
            ];
        }, $galleriesResponse);

        // Banner tetap sama
        $banners = array_map(function ($b) {
            return [
                'image' => $this->imgUrl . '/storage/' . ($b['image'] ?? ''),
            ];
        }, $bannersResponse);

        return compact('categoriesFields', 'categoriesGalleries', 'galleries', 'banners');
    }


    private function mapImages(array $fields)
    {
        return array_map(function ($field) {
            if (!empty($field['image'])) {
                $field['image'] = $this->imgUrl . '/storage/' . $field['image'];
            } else {
                $field['image'] = asset('aset/no-image.png');
            }
            return $field;
        }, $fields);
    }
}

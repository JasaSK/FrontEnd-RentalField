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

        $data['fields'] = $fields;
        $data['isSearch'] = !empty($params);
        $data['showAll'] = $request->get('show') === 'all';
        $data['request'] = $request;

        return view('beranda.index', $data);
    }

    public function search(Request $request)
    {
        $request->validate([
            'tanggal_main' => 'nullable|date',
            'open_time' => 'nullable|string',
            'close_time' => 'nullable|string',
            'category_field_id' => 'nullable|numeric',
        ]);

        // Panggil endpoint BE POST
        $response = Http::post("{$this->apiUrl}/fields/search", [
            'tanggal_main'      => $request->input('tanggal_main'),
            'open_time'         => $request->input('open_time'),
            'close_time'        => $request->input('close_time'),
            'category_field_id' => $request->input('category_field_id'),
        ]);

        $fields = $response->successful() ? $response->json()['data'] ?? [] : [];
        $fields = $this->mapImages($fields);

        $data = $this->getDefaultData();
        $data['fields'] = $fields;
        $data['isSearch'] = true;
        $data['showAll'] = false;
        $data['request'] = $request;

        return view('beranda.index', $data);
    }

    private function getDefaultData()
    {
        $categoriesFields = Http::get("{$this->apiUrl}/category-fields")->json()['data'] ?? [];
        $categoriesGalleries = Http::get("{$this->apiUrl}/category-gallery")->json()['data'] ?? [];

        $galleriesResponse = Http::get("{$this->apiUrl}/galleries")->json()['data'] ?? [];
        $bannersResponse = Http::get("{$this->apiUrl}/banners")->json()['data'] ?? [];

        $galleries = array_map(fn($g) => ['image' => $this->imgUrl . '/storage/' . ($g['image'] ?? '')], $galleriesResponse);
        $galleries = array_map(function ($g) {
            return [
                'image' => $this->imgUrl . '/storage/' . ($g['image'] ?? ''),
                'category_gallery' => $g['category_gallery'] ?? ['name' => 'unknown'],
            ];
        }, $galleriesResponse);

        $banners = array_map(fn($b) => ['image' => $this->imgUrl . '/storage/' . ($b['image'] ?? '')], $bannersResponse);

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

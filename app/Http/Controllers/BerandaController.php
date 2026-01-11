<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BerandaController extends Controller
{
    private string $apiUrl;
    private string $imgUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api_service.url');
        $this->imgUrl = config('services.api_image.url');
    }

    /* =====================
       BERANDA DEFAULT
    ===================== */
    public function index(Request $request)
    {
        $data = $this->getDefaultData();

        $params = array_filter([
            'tanggal_main'      => $request->tanggal_main,
            'open_time'         => $request->open_time,
            'close_time'        => $request->close_time,
            'category_field_id' => $request->category_field_id,
        ]);

        $fields = $this->fetchFields($params);

        $showAll = $request->query('show') === 'all';
        $limit   = $showAll ? count($fields) : 4;

        $data += [
            'fields'      => array_slice($fields, 0, $limit),
            'totalFields' => count($fields),
            'limit'       => $limit,
            'isSearch'    => !empty($params),
            'showAll'     => $showAll,
            'request'     => $request->all(),
        ];

        return view('beranda.index', $data);
    }

    /* =====================
       SEARCH
    ===================== */
    public function search(Request $request)
    {
        $validated = $request->validate([
            'tanggal_main'      => 'nullable|date',
            'open_time'         => 'nullable|string',
            'close_time'        => 'nullable|string',
            'category_field_id' => 'nullable|numeric',
        ]);

        $validated['tanggal_main'] ??= now()->toDateString();

        $response = Http::post("{$this->apiUrl}/fields/search", $validated);

        $fields = $response->successful()
            ? $this->mapImages($response->json('data', []))
            : [];

        session([
            'search_results' => $fields,
            'search_params'  => $validated,
        ]);

        return redirect()->route('beranda.search.result');
    }

    /* =====================
       SEARCH RESULT
    ===================== */
    public function searchResult(Request $request)
    {
        $allFields = session('search_results', []);
        $params    = session('search_params', []);

        $showAll = $request->query('show') === 'all';
        $limit   = $showAll ? count($allFields) : 4;

        $data = $this->getDefaultData();
        $data += [
            'fields'      => array_slice($allFields, 0, $limit),
            'totalFields' => count($allFields),
            'limit'       => $limit,
            'isSearch'    => true,
            'showAll'     => $showAll,
            'request'     => $params,
        ];

        return view('beranda.index', $data);
    }

    /* =====================
       DEFAULT DATA
    ===================== */
    private function getDefaultData(): array
    {
        return [
            'categoriesFields'    => $this->fetchApi('category-fields'),
            'categoriesGalleries' => $this->fetchApi('category-gallery'),
            'galleries'           => $this->mapGalleryImages($this->fetchApi('galleries')),
            'banners'             => $this->mapBannerImages($this->fetchApi('banners')),
        ];
    }

    /* =====================
       API HELPERS
    ===================== */
    private function fetchApi(string $endpoint): array
    {
        return Http::get("{$this->apiUrl}/{$endpoint}")
            ->json('data', []);
    }

    private function fetchFields(array $params = []): array
    {
        $response = Http::get("{$this->apiUrl}/fields", $params);

        return $response->successful()
            ? $this->mapImages($response->json('data', []))
            : [];
    }

    /* =====================
       IMAGE MAPPERS
    ===================== */
    private function mapImages(array $fields): array
    {
        return array_map(function ($field) {
            $field['image'] = !empty($field['image'])
                ? "{$this->imgUrl}/storage/{$field['image']}"
                : asset('aset/no-image.png');

            return $field;
        }, $fields);
    }

    private function mapGalleryImages(array $galleries): array
    {
        return array_map(fn($g) => [
            'image' => "{$this->imgUrl}/storage/" . ($g['image'] ?? ''),
            'category_gallery' => $g['category_gallery'] ?? ['name' => 'unknown'],
        ], $galleries);
    }

    private function mapBannerImages(array $banners): array
    {
        return array_map(fn($b) => [
            'image' => "{$this->imgUrl}/storage/" . ($b['image'] ?? ''),
        ], $banners);
    }
}

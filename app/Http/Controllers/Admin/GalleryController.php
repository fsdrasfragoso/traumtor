<?php

namespace App\Http\Controllers\Admin;

use App\Models\Album;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\Media;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('gallery', Album::class);

        $album = $this->getDefaultAlbum();

        $params = $request->all();

        $search = data_get($params, 'q');

        $resources = Media::query()
            ->where('model_type', Album::class)
            ->where('model_id', $album->id)
            ->adminSearch($search)
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('admin.gallery.index')
            ->with('type', Media::class)
            ->with('instance', new Album())
            ->with('resources', $resources);
    }

    /**
     * Listing in the WYSIWYG browser image upload
     *
     * @param Request $request
     * @return Album
     */
    public function browser(Request $request)
    {
        $this->authorize('gallery', Album::class);

        $album = $this->getDefaultAlbum();

        $params = $request->all();

        $search = data_get($params, 'q');

        $resources = Media::query()
            ->where('model_type', Album::class)
            ->where('model_id', $album->id)
            ->adminSearch($search)
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('admin.gallery.browser')
            ->with('type', Media::class)
            ->with('instance', new Album())
            ->with('resources', $resources);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return RedirectResponse
     *
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded
     */
    public function store(Request $request)
    {
        $this->authorize('gallery', Album::class);

        $album = $this->getDefaultAlbum();

        $album->addMedia($request->file)
            ->toMediaCollection();

        return redirect()
            ->back()
            ->with('success', __('Arquivo enviado com sucesso'));
    }

    /**
     * Uploading images in WYSIWYG browser
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded
     * @throws \Spatie\MediaLibrary\Exceptions\InvalidConversion
     */
    public function fileUpload(Request $request)
    {
        $this->authorize('gallery', Album::class);

        $album = $this->getDefaultAlbum();

        $media = $album->addMedia($request->upload)
            ->toMediaCollection();

        return response()->json([
            'uploaded' => 1,
            'fileName' => $media->file_name,
            'url' => $media->getUrl(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $mediaId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->authorize('gallery', Album::class);

        $album = $this->getDefaultAlbum();

        $album->getMedia()
            ->keyBy('id')
            ->get($id)
            ->delete();

        return redirect()
            ->back()
            ->with('success', __('Arquivo excluído com sucesso'));
    }

    /**
     * Get default album
     *
     * @return Album
     */
    protected function getDefaultAlbum()
    {
        $album = Album::query()
            ->where('type', 'default')
            ->first();

        if (!$album) {
            $album = new Album();
            $album->type = 'default';
            $album->title = 'default';
            $album->slug = 'default';
            $album->save();
        }

        return $album;
    }
}

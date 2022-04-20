<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyGaleriainteriorRequest;
use App\Http\Requests\StoreGaleriainteriorRequest;
use App\Http\Requests\UpdateGaleriainteriorRequest;
use App\Models\Galeriainterior;
use App\Models\Pantalla;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class GaleriainteriorController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('galeriainterior_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $galeriainteriors = Galeriainterior::with(['id_pantalla', 'media'])->get();

        return view('admin.galeriainteriors.index', compact('galeriainteriors'));
    }

    public function create()
    {
        abort_if(Gate::denies('galeriainterior_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_pantallas = Pantalla::pluck('name_screen', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.galeriainteriors.create', compact('id_pantallas'));
    }

    public function store(StoreGaleriainteriorRequest $request)
    {
        $galeriainterior = Galeriainterior::create($request->all());

        if ($request->input('gallery_1', false)) {
            $galeriainterior->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery_1'))))->toMediaCollection('gallery_1');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $galeriainterior->id]);
        }

        return redirect()->route('admin.galeriainteriors.index');
    }

    public function edit(Galeriainterior $galeriainterior)
    {
        abort_if(Gate::denies('galeriainterior_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_pantallas = Pantalla::pluck('name_screen', 'id')->prepend(trans('global.pleaseSelect'), '');

        $galeriainterior->load('id_pantalla');

        return view('admin.galeriainteriors.edit', compact('galeriainterior', 'id_pantallas'));
    }

    public function update(UpdateGaleriainteriorRequest $request, Galeriainterior $galeriainterior)
    {
        $galeriainterior->update($request->all());

        if ($request->input('gallery_1', false)) {
            if (!$galeriainterior->gallery_1 || $request->input('gallery_1') !== $galeriainterior->gallery_1->file_name) {
                if ($galeriainterior->gallery_1) {
                    $galeriainterior->gallery_1->delete();
                }
                $galeriainterior->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery_1'))))->toMediaCollection('gallery_1');
            }
        } elseif ($galeriainterior->gallery_1) {
            $galeriainterior->gallery_1->delete();
        }

        return redirect()->route('admin.galeriainteriors.index');
    }

    public function show(Galeriainterior $galeriainterior)
    {
        abort_if(Gate::denies('galeriainterior_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $galeriainterior->load('id_pantalla');

        return view('admin.galeriainteriors.show', compact('galeriainterior'));
    }

    public function destroy(Galeriainterior $galeriainterior)
    {
        abort_if(Gate::denies('galeriainterior_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $galeriainterior->delete();

        return back();
    }

    public function massDestroy(MassDestroyGaleriainteriorRequest $request)
    {
        Galeriainterior::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('galeriainterior_create') && Gate::denies('galeriainterior_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Galeriainterior();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

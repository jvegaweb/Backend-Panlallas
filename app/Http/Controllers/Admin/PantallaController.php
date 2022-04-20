<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPantallaRequest;
use App\Http\Requests\StorePantallaRequest;
use App\Http\Requests\UpdatePantallaRequest;
use App\Models\Espacioscomune;
use App\Models\Galeriainterior;
use App\Models\Pantalla;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PantallaController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pantalla_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pantallas = Pantalla::with(['id_gallery_1s', 'id_gallery_2s', 'media'])->get();

        return view('admin.pantallas.index', compact('pantallas'));
    }

    public function create()
    {
        abort_if(Gate::denies('pantalla_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_gallery_1s = Galeriainterior::pluck('name', 'id');

        $id_gallery_2s = Espacioscomune::pluck('name', 'id');

        return view('admin.pantallas.create', compact('id_gallery_1s', 'id_gallery_2s'));
    }

    public function store(StorePantallaRequest $request)
    {
        $pantalla = Pantalla::create($request->all());
        $pantalla->id_gallery_1s()->sync($request->input('id_gallery_1s', []));
        $pantalla->id_gallery_2s()->sync($request->input('id_gallery_2s', []));
        if ($request->input('cod_qr', false)) {
            $pantalla->addMedia(storage_path('tmp/uploads/' . basename($request->input('cod_qr'))))->toMediaCollection('cod_qr');
        }

        if ($request->input('logo', false)) {
            $pantalla->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($request->input('caracteristica_1', false)) {
            $pantalla->addMedia(storage_path('tmp/uploads/' . basename($request->input('caracteristica_1'))))->toMediaCollection('caracteristica_1');
        }

        if ($request->input('caracteristica_2', false)) {
            $pantalla->addMedia(storage_path('tmp/uploads/' . basename($request->input('caracteristica_2'))))->toMediaCollection('caracteristica_2');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $pantalla->id]);
        }

        return redirect()->route('admin.pantallas.index');
    }

    public function edit(Pantalla $pantalla)
    {
        abort_if(Gate::denies('pantalla_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_gallery_1s = Galeriainterior::pluck('name', 'id');

        $id_gallery_2s = Espacioscomune::pluck('name', 'id');

        $pantalla->load('id_gallery_1s', 'id_gallery_2s');

        return view('admin.pantallas.edit', compact('id_gallery_1s', 'id_gallery_2s', 'pantalla'));
    }

    public function update(UpdatePantallaRequest $request, Pantalla $pantalla)
    {
        $pantalla->update($request->all());
        $pantalla->id_gallery_1s()->sync($request->input('id_gallery_1s', []));
        $pantalla->id_gallery_2s()->sync($request->input('id_gallery_2s', []));
        if ($request->input('cod_qr', false)) {
            if (!$pantalla->cod_qr || $request->input('cod_qr') !== $pantalla->cod_qr->file_name) {
                if ($pantalla->cod_qr) {
                    $pantalla->cod_qr->delete();
                }
                $pantalla->addMedia(storage_path('tmp/uploads/' . basename($request->input('cod_qr'))))->toMediaCollection('cod_qr');
            }
        } elseif ($pantalla->cod_qr) {
            $pantalla->cod_qr->delete();
        }

        if ($request->input('logo', false)) {
            if (!$pantalla->logo || $request->input('logo') !== $pantalla->logo->file_name) {
                if ($pantalla->logo) {
                    $pantalla->logo->delete();
                }
                $pantalla->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($pantalla->logo) {
            $pantalla->logo->delete();
        }

        if ($request->input('caracteristica_1', false)) {
            if (!$pantalla->caracteristica_1 || $request->input('caracteristica_1') !== $pantalla->caracteristica_1->file_name) {
                if ($pantalla->caracteristica_1) {
                    $pantalla->caracteristica_1->delete();
                }
                $pantalla->addMedia(storage_path('tmp/uploads/' . basename($request->input('caracteristica_1'))))->toMediaCollection('caracteristica_1');
            }
        } elseif ($pantalla->caracteristica_1) {
            $pantalla->caracteristica_1->delete();
        }

        if ($request->input('caracteristica_2', false)) {
            if (!$pantalla->caracteristica_2 || $request->input('caracteristica_2') !== $pantalla->caracteristica_2->file_name) {
                if ($pantalla->caracteristica_2) {
                    $pantalla->caracteristica_2->delete();
                }
                $pantalla->addMedia(storage_path('tmp/uploads/' . basename($request->input('caracteristica_2'))))->toMediaCollection('caracteristica_2');
            }
        } elseif ($pantalla->caracteristica_2) {
            $pantalla->caracteristica_2->delete();
        }

        return redirect()->route('admin.pantallas.index');
    }

    public function show(Pantalla $pantalla)
    {
        abort_if(Gate::denies('pantalla_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pantalla->load('id_gallery_1s', 'id_gallery_2s', 'screenClientes');

        return view('admin.pantallas.show', compact('pantalla'));
    }

    public function destroy(Pantalla $pantalla)
    {
        abort_if(Gate::denies('pantalla_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pantalla->delete();

        return back();
    }

    public function massDestroy(MassDestroyPantallaRequest $request)
    {
        Pantalla::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('pantalla_create') && Gate::denies('pantalla_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Pantalla();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

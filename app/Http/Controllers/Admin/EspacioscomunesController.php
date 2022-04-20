<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEspacioscomuneRequest;
use App\Http\Requests\StoreEspacioscomuneRequest;
use App\Http\Requests\UpdateEspacioscomuneRequest;
use App\Models\Espacioscomune;
use App\Models\Pantalla;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EspacioscomunesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('espacioscomune_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $espacioscomunes = Espacioscomune::with(['id_pantalla', 'media'])->get();

        return view('admin.espacioscomunes.index', compact('espacioscomunes'));
    }

    public function create()
    {
        abort_if(Gate::denies('espacioscomune_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_pantallas = Pantalla::pluck('name_screen', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.espacioscomunes.create', compact('id_pantallas'));
    }

    public function store(StoreEspacioscomuneRequest $request)
    {
        $espacioscomune = Espacioscomune::create($request->all());

        if ($request->input('gallery_2', false)) {
            $espacioscomune->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery_2'))))->toMediaCollection('gallery_2');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $espacioscomune->id]);
        }

        return redirect()->route('admin.espacioscomunes.index');
    }

    public function edit(Espacioscomune $espacioscomune)
    {
        abort_if(Gate::denies('espacioscomune_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id_pantallas = Pantalla::pluck('name_screen', 'id')->prepend(trans('global.pleaseSelect'), '');

        $espacioscomune->load('id_pantalla');

        return view('admin.espacioscomunes.edit', compact('espacioscomune', 'id_pantallas'));
    }

    public function update(UpdateEspacioscomuneRequest $request, Espacioscomune $espacioscomune)
    {
        $espacioscomune->update($request->all());

        if ($request->input('gallery_2', false)) {
            if (!$espacioscomune->gallery_2 || $request->input('gallery_2') !== $espacioscomune->gallery_2->file_name) {
                if ($espacioscomune->gallery_2) {
                    $espacioscomune->gallery_2->delete();
                }
                $espacioscomune->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery_2'))))->toMediaCollection('gallery_2');
            }
        } elseif ($espacioscomune->gallery_2) {
            $espacioscomune->gallery_2->delete();
        }

        return redirect()->route('admin.espacioscomunes.index');
    }

    public function show(Espacioscomune $espacioscomune)
    {
        abort_if(Gate::denies('espacioscomune_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $espacioscomune->load('id_pantalla');

        return view('admin.espacioscomunes.show', compact('espacioscomune'));
    }

    public function destroy(Espacioscomune $espacioscomune)
    {
        abort_if(Gate::denies('espacioscomune_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $espacioscomune->delete();

        return back();
    }

    public function massDestroy(MassDestroyEspacioscomuneRequest $request)
    {
        Espacioscomune::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('espacioscomune_create') && Gate::denies('espacioscomune_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Espacioscomune();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

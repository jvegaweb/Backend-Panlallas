<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEspacioscomuneRequest;
use App\Http\Requests\UpdateEspacioscomuneRequest;
use App\Http\Resources\Admin\EspacioscomuneResource;
use App\Models\Espacioscomune;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EspacioscomunesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('espacioscomune_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EspacioscomuneResource(Espacioscomune::with(['id_pantalla'])->get());
    }

    public function store(StoreEspacioscomuneRequest $request)
    {
        $espacioscomune = Espacioscomune::create($request->all());

        if ($request->input('gallery_2', false)) {
            $espacioscomune->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery_2'))))->toMediaCollection('gallery_2');
        }

        return (new EspacioscomuneResource($espacioscomune))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Espacioscomune $espacioscomune)
    {
        abort_if(Gate::denies('espacioscomune_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EspacioscomuneResource($espacioscomune->load(['id_pantalla']));
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

        return (new EspacioscomuneResource($espacioscomune))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Espacioscomune $espacioscomune)
    {
        abort_if(Gate::denies('espacioscomune_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $espacioscomune->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

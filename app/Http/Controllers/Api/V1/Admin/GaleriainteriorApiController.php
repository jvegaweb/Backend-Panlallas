<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreGaleriainteriorRequest;
use App\Http\Requests\UpdateGaleriainteriorRequest;
use App\Http\Resources\Admin\GaleriainteriorResource;
use App\Models\Galeriainterior;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GaleriainteriorApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('galeriainterior_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GaleriainteriorResource(Galeriainterior::with(['id_pantalla'])->get());
    }

    public function store(StoreGaleriainteriorRequest $request)
    {
        $galeriainterior = Galeriainterior::create($request->all());

        if ($request->input('gallery_1', false)) {
            $galeriainterior->addMedia(storage_path('tmp/uploads/' . basename($request->input('gallery_1'))))->toMediaCollection('gallery_1');
        }

        return (new GaleriainteriorResource($galeriainterior))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Galeriainterior $galeriainterior)
    {
        abort_if(Gate::denies('galeriainterior_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GaleriainteriorResource($galeriainterior->load(['id_pantalla']));
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

        return (new GaleriainteriorResource($galeriainterior))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Galeriainterior $galeriainterior)
    {
        abort_if(Gate::denies('galeriainterior_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $galeriainterior->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

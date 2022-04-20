<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePantallaRequest;
use App\Http\Requests\UpdatePantallaRequest;
use App\Http\Resources\Admin\PantallaResource;
use App\Models\Pantalla;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PantallaApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pantalla_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PantallaResource(Pantalla::with(['id_gallery_1s', 'id_gallery_2s'])->get());
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

        return (new PantallaResource($pantalla))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Pantalla $pantalla)
    {
        abort_if(Gate::denies('pantalla_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PantallaResource($pantalla->load(['id_gallery_1s', 'id_gallery_2s']));
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

        return (new PantallaResource($pantalla))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Pantalla $pantalla)
    {
        abort_if(Gate::denies('pantalla_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pantalla->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

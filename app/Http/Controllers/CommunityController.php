<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCommunityRequest;
use App\Services\CommunityService;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    protected $service;

    public function __construct(CommunityService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            $filters = $request->all();
            $result = $this->service->index($filters);

            return response()->json($result, 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao listar comunidades'
            ], 500);
        }
    }

    public function store(StoreUpdateCommunityRequest $request)
    {
        try {
            $result = $this->service->store($request->validated());

            if (!$result['success']) {
                return response()->json($result, 400);
            }

            return response()->json($result, 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao criar comunidade'
            ], 500);
        }
    }

    public function update(StoreUpdateCommunityRequest $request, $uuid)
    {
        try {
            $result = $this->service->update($uuid, $request->validated());

            if (!$result['success']) {
                return response()->json($result, 400);
            }

            return response()->json($result, 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar comunidade'
            ], 500);
        }
    }

    public function destroy($uuid)
    {
        try {
            $result = $this->service->destroy($uuid);

            if (!$result['success']) {
                return response()->json($result, 400);
            }

            return response()->json($result, 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao excluir comunidade'
            ], 500);
        }
    }
}

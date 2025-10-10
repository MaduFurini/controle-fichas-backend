<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
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
                'message' => 'Erro ao listar usuários'
            ], 500);
        }
    }

    public function store(StoreUpdateUserRequest $request)
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
                'message' => 'Erro ao criar usuário'
            ], 500);
        }
    }

    public function update(StoreUpdateUserRequest $request, $uuid)
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
                'message' => 'Erro ao atualizar usuário'
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
                'message' => 'Erro ao excluir usuário'
            ], 500);
        }
    }
}

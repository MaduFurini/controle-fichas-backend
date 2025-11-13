<?php

namespace App\Services;

use App\Helpers\RelationshipChecker;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserService
{
    public function index(array $filters = [])
    {
        $query = User::query();

        $likeData = ['name', 'email'];
        $noLikeData = ['community_id', 'code', 'status'];

        foreach ($filters as $key => $value) {
            if (in_array($key, $likeData)) {
                $query->where($key, 'like', "%{$value}%");
            } elseif (in_array($key, $noLikeData)) {
                $query->where($key, $value);
            }
        }

        $totalItens = (clone $query)->count();

        if (isset($filters['limit']) && is_numeric($filters['limit'])) {
            $query->limit((int) $filters['limit']);
        }

        if (isset($filters['offset']) && is_numeric($filters['offset'])) {
            $query->offset((int) $filters['offset']);
        }

        return [
            'limit' => $filters['limit'] ?? null,
            'offset' => $filters['offset'] ?? null,
            'data_count' => $totalItens,
            'data' => UserResource::collection($query->get())
        ];
    }

    public function store(array $data)
    {
        $exists = User::where('email', $data['email'])->exists();

        if ($exists) {
            return [
                'success' => false,
                'message' => 'Usuário já existente com esse email'
            ];
        };

        User::create($data);

        return [
            'success' => true,
            'message' => 'Usuário criado com sucesso!'
        ];
    }

    public function update($uuid, array $data)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Usuário não encontrado'
            ];
        }

        $community_id = $data['community_id'] ?? $user->community_id;
        $email = $data['email'] ?? $user->name;
        $code = $data['code'] ?? $user->code;

        $exists = User::where('email', $email)
            ->where('id', '<>', $user->id)
            ->exists();

        if ($exists) {
            return [
                'success' => false,
                'message' => 'Já existe um usuário com esse email'
            ];
        }

        $exists = User::where('code', $code)
            ->where('community_id', $community_id)
            ->where('id', '<>', $user->id)
            ->exists();

        if ($exists) {
            return [
                'success' => false,
                'message' => 'Já existe um usuário com esse código para essa comunidade'
            ];
        }

        $user->update($data);
        $user->save();

        return [
            'success' => true,
            'message' => 'Usuário atualizado com sucesso',
        ];
    }

    public function destroy($uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        if (!$user) {
            return [
                'success' => false,
                'message' => 'Usuário não encontrado'
            ];
        }

        $hasRelationship = RelationshipChecker::hasRelationship('user_id', $user->id);

        if ($hasRelationship) {
            $user->update(['status' => false]);
            $user->save();

            $message = 'O usuário possui relação com outros itens, portanto não pode ser excluído, apenas inativado';
        } else {
            $user->delete();

            $message = 'Usuário excluído com sucesso';
        }

        return [
            'success' => true,
            'message' => $message
        ];
    }
}

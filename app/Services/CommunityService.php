<?php

namespace App\Services;

use App\Helpers\RelationshipChecker;
use App\Http\Resources\CommunityResource;
use App\Models\Community;

class CommunityService
{
    public function index(array $filters = [])
    {
        $query = Community::query();

        $likeData = ['name'];
        $noLikeData = ['uuid', 'zip_code'];

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
            'data' => CommunityResource::collection($query->get())
        ];
    }

    public function store(array $data)
    {
        $exists = Community::where('name', $data['name'])
            ->where('zip_code', $data['zip_code'])
            ->exists();

        if ($exists) {
            return [
                'success' => false,
                'message' => 'Comunidade já existente com esse nome e CEP'
            ];
        };

        Community::create($data);

        return [
            'success' => true,
            'message' => 'Comunidade criada com sucesso!'
        ];
    }

    public function update($uuid, array $data)
    {
        $community = Community::where('uuid', $uuid)->firstOrFail();

        if (!$community) {
            return [
                'success' => false,
                'message' => 'Comunidade não encontrada'
            ];
        }

        $name = $data['name'] ?? $community->name;
        $zipCode = $data['zip_code'] ?? $community->zip_code;

        $exists = Community::where('name', $name)
            ->where('zip_code', $zipCode)
            ->where('id', '<>', $community->id)
            ->exists();

        if ($exists) {
            return [
                'success' => false,
                'message' => 'Já existe uma comunidade com esse nome e CEP'
            ];
        }

        $community->update($data);
        $community->save();

        return [
            'success' => true,
            'message' => 'Comunidade atualizada com sucesso',
        ];
    }

    public function destroy($uuid)
    {
        $community = Community::where('uuid', $uuid)->firstOrFail();

        if (!$community) {
            return [
                'success' => false,
                'message' => 'Comunidade não encontrada'
            ];
        }

        $hasRelationship = RelationshipChecker::hasRelationship('community_id', $community->id);

        if ($hasRelationship) {
            $community->update(['status', 0]);
            $community->save();

            $message = 'A comunidade possui relação com outros itens, portanto não pode ser excluída, apenas inativada';
        } else {
            $community->delete();

            $message = 'Comunidade excluída com sucesso';
        }

        return [
            'success' => true,
            'message' => $message
        ];
    }
}

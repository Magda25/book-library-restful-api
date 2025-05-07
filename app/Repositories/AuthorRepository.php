<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Builder;

class AuthorRepository
{
    public function filter(array $filters): Builder
    {
        return Author::query()
            ->when($filters['name'] ?? false, fn($q) => $q->where('name', 'like', '%' . $filters['name'] . '%'))
            ->when($filters['sort_by'] ?? false, function ($q) use ($filters) {
                $q->orderBy($filters['sort_by'], $filters['sort_dir'] ?? 'asc');
            });
    }

    public function create(array $data): Author
    {
        return Author::create($data);
    }

    public function update(Author $author, array $data): Author
    {
        $author->update($data);
        return $author;
    }

    public function delete(Author $author): void
    {
        $author->delete();
    }
}

<?php

namespace App\Services;

use App\Models\Author;
use App\Repositories\AuthorRepository;

class AuthorService
{
    public function __construct(protected AuthorRepository $repo) {}

    public function create(array $data): Author
    {
        return $this->repo->create($data);
    }

    public function update(Author $author, array $data): Author
    {
        return $this->repo->update($author, $data);
    }
}

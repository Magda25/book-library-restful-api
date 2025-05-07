<?php

namespace App\Services;

use App\Models\Book;
use App\Repositories\BookRepository;

class BookService
{
    public function __construct(protected BookRepository $repo) {}

    public function getCoverUrl(string $query): ?string
    {
        $query = urlencode($query);
        $url = "https://covers.openlibrary.org/b/isbn/{$query}-L.jpg";

        if (!@getimagesize($url)) {
            $url = "https://covers.openlibrary.org/b/title/{$query}-L.jpg";
            if (!@getimagesize($url)) return null;
        }

        return $url;
    }

    public function create(array $data): Book
    {
        $data['cover_url'] = $this->getCoverUrl($data['isbn'] ?? $data['title']);
        return $this->repo->create($data);
    }

    public function update(Book $book, array $data): Book
    {
        if (isset($data['isbn']) || isset($data['title'])) {
            $data['cover_url'] = $this->getCoverUrl($data['isbn'] ?? $data['title']);
        }

        return $this->repo->update($book, $data);
    }
}

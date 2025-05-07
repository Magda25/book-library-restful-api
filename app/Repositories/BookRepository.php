<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;

class BookRepository
{
    public function filter(array $filters): Builder
    {
        return Book::with('author')
            ->when($filters['title'] ?? false, fn($q) => $q->where('title', 'like', '%' . $filters['title'] . '%'))
            ->when($filters['isbn'] ?? false, fn($q) => $q->where('isbn', $filters['isbn']))
            ->when($filters['author'] ?? false, function ($q) use ($filters) {
                $q->whereHas('author', fn($a) => $a->where('name', 'like', '%' . $filters['author'] . '%'));
            })
            ->when($filters['sort_by'] ?? false, function ($q) use ($filters) {
                $q->orderBy($filters['sort_by'], $filters['sort_dir'] ?? 'asc');
            });
    }

    public function create(array $data): Book
    {
        return Book::create($data);
    }

    public function update(Book $book, array $data): Book
    {
        $book->update($data);
        return $book;
    }

    public function delete(Book $book): void
    {
        $book->delete();
    }
}

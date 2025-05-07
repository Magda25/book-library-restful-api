<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;

use App\Services\BookService;
use App\Repositories\BookRepository;

class BookController extends Controller
{
    public function __construct(
        protected BookService $service,
        protected BookRepository $repo
    ) {}
    
    public function index(Request $request)
    {
        $books = $this->repo->filter($request->all())->paginate(10);
        return BookResource::collection($books);
    }

    public function show(Book $book)
    {
        return new BookResource($book->load('author'));
    }

    public function store(StoreBookRequest $request)
    {
        $book = $this->service->create($request->validated());
        return new BookResource($book->load('author'));
    }
    
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book = $this->service->update($book, $request->validated());
        return new BookResource($book->load('author'));
    }
    
    public function destroy(Book $book)
    {
        $this->repo->delete($book);
        return response()->json(null, 204);
    }
}

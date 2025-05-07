<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;

use App\Services\AuthorService;
use App\Repositories\AuthorRepository;

class AuthorController extends Controller
{
    public function __construct(
        protected AuthorService $service,
        protected AuthorRepository $repo
    ) {}
    
    public function index(Request $request)
    {
        $authors = $this->repo->filter($request->all())->paginate(10);
        return AuthorResource::collection($authors);
    }
    
    public function store(StoreAuthorRequest $request)
    {
        $author = $this->service->create($request->validated());
        return new AuthorResource($author);
    }
    
    public function show(Author $author)
    {
        return new AuthorResource($author);
    }
    
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $author = $this->service->update($author, $request->validated());
        return new AuthorResource($author);
    }
    
    public function destroy(Author $author)
    {
        $this->repo->delete($author);
        return response()->json(null, 204);
    }
}

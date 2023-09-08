<?php

namespace App\Services;

use App\Models\User;
use App\Models\Wish;

class SearchService
{

    public function search(string $searchTerm): array
    {
        $users = User::where('name', 'LIKE', "%$searchTerm%")->get();
        $wishes = Wish::where('title', 'LIKE', "%$searchTerm%")->get();

        return ['users' => $users, 'wishes' => $wishes];
    }
}

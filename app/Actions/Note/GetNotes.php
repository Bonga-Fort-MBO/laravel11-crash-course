<?php

namespace App\Actions\Note;

use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetNotes
{
    public function __invoke()
    {
        /** @var User $user */
        $user = Auth::user();

        return Note::query()
            ->when($user->role !== 'admin', fn ($query) => $query->where('user_id', $user->id))
            ->orderBy('created_at', 'desc')
            ->paginate();
    }
}

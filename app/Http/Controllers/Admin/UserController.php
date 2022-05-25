<?php

namespace App\Http\Controllers\Admin;

use App\Actions\User\StoreAction;
use App\Models\User;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    private const PAGINATION_COUNT = 10;
    private StoreAction $storeAction;

    public function __construct(StoreAction $storeAction)
    {
        $this->storeAction = $storeAction;
    }

    public function index(): View
    {
        $users = User::latest()->paginate(self::PAGINATION_COUNT);

        return view('admin.user.index', compact(nameof($users)));
    }

    public function create(): View
    {
        return view('admin.user.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $this->storeAction->handle($request->validated());

        return to_route('admin.user.index');
    }
}

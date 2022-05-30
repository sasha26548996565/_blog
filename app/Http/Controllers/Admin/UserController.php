<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Filters\UserFilter;
use App\Actions\User\StoreAction;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\FilterRequest;

class UserController extends Controller
{
    private const PAGINATION_COUNT = 10;
    private StoreAction $storeAction;

    public function __construct(StoreAction $storeAction)
    {
        $this->storeAction = $storeAction;
    }

    public function index(FilterRequest $request): View
    {
        $filter = app()->make(UserFilter::class, ['queryParams' => array_filter( $request->validated())]);
        $users = User::withTrashed()->filter($filter)->latest()->paginate(self::PAGINATION_COUNT);

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

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return to_route('admin.user.index');
    }

    public function restore(int $userId): RedirectResponse
    {
        User::withTrashed()->findOr($userId, fn () => abort(404))->restore();

        return to_route('admin.user.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListingRequest;
use App\Listing;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ListingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * ログインしているユーザーに関連するlistingを取得
     *
     * @return Factory|View
     */
    public function index()
    {
        $listings = Listing::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('listing.index', compact('listings'));
    }

    /**
     * 新しくlistingを作成する画面
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('listing.create');
    }

    /**
     * 投稿したlistingを保存する処理
     *
     * @param ListingRequest $request
     * @return RedirectResponse
     */
    public function store(ListingRequest $request)
    {
        $inputs = $request->validated();

        try {
            DB::beginTransaction();

            Listing::create([
                'title' => array_get($inputs, 'list_name'),
                'user_id' => Auth::user()->id,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500);
        }

        return redirect()->route('listing.index');
    }

    /**
     * 投稿してあるlistingを編集する画面
     *
     * @param Listing $listing
     * @return Factory|View
     */
    public function edit(Listing $listing)
    {
        return view('listing.edit', compact('listing'));
    }

    /**
     * 投稿してあるlistingを編集する処理
     *
     * @param ListingRequest $request
     * @param Listing $listing
     * @return RedirectResponse
     */
    public function update(ListingRequest $request, Listing $listing)
    {
        $inputs = $request->validated();

        try {
            DB::beginTransaction();

            $listing->update([
                'title' => array_get($inputs, 'list_name'),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500);
        }

        return redirect()->route('listing.index');
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->route('listing.index');
    }
}

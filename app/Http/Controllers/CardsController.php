<?php

namespace App\Http\Controllers;

use App\Card;
use App\Http\Requests\CardRequest;
use App\Listing;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 新しくカードを作成する画面
     *
     * @param Listing $listing
     * @return Factory|View
     */
    public function create(Listing $listing)
    {
        return view('card.create', compact('listing'));
    }

    /**
     * 作成したカードを保存する処理
     *
     * @param CardRequest $request
     * @param Listing $listing
     * @return RedirectResponse
     */
    public function store(CardRequest $request, Listing $listing)
    {
        $inputs = $request->validated();

        try {
            DB::beginTransaction();

            Card::create([
                'title' => array_get($inputs, 'card_title'),
                'memo' => array_get($inputs, 'card_memo'),
                'listing_id' => $listing->id,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500);
        }

        return redirect()->route('listing.index');
    }

    /**
     * カードの詳細画面
     *
     * @param Listing $listing
     * @param Card $card
     * @return Factory|View
     */
    public function show(Listing $listing, Card $card)
    {
        return view('card.show', compact('listing', 'card'));
    }

    /**
     * カードの編集画面
     *
     * @param Listing $listing
     * @param Card $card
     * @return Factory|View
     */
    public function edit(Listing $listing, Card $card)
    {
        $listings = Listing::where('user_id', $listing->user_id)->get();

        return view('card.edit', compact('listings', 'listing', 'card'));
    }

    /**
     * カードの編集処理
     *
     * @param CardRequest $request
     * @param Listing $listing
     * @param Card $card
     * @return RedirectResponse
     */
    public function update(CardRequest $request, Listing $listing, Card $card)
    {
        $inputs = $request->validated();

        try {
            DB::beginTransaction();

            $card->update([
                'title' => array_get($inputs, 'card_title'),
                'memo' => array_get($inputs, 'card_memo'),
                'listing_id' => $listing->id,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500);
        }

        return redirect()->route('listing.card.show', [$listing, $card]);
    }

    /**
     * カードの削除処理
     *
     * @param Listing $listing
     * @param Card $card
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Listing $listing, Card $card)
    {
        $card->delete();

        return redirect()->route('listing.index');
    }
}

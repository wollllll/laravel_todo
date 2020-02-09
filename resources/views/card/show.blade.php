@extends('layouts.app')
@section('content')
    <div class='carddetailPage'>
        <div class="container">
            <div class="cardContents">
                <div class="cardContents_title">
                    <div>タイトル</div>
                    <h2>{{ $card->title }}</h2>
                </div>
                <div class="cardContents_memo">
                    <div>メモ</div>
                    <div>{{ $card->memo }}</div>
                </div>
                <div class="cardContents_listStatus">
                    <div>リスト名</div>
                    <div>{{ $listing->title }}</div>
                </div>
                <div class="cardContents_btnArea">
                    <a class="edit_btn" href="{{ route('listing.card.edit', [$listing, $card]) }}">編集する</a>
                    <a class="text-danger delete_btn" onclick="return confirm('このカードを削除して大丈夫ですか?')" rel="nofollow"
                       data-method="delete" href="{{ route('listing.card.delete', [$listing, $card]) }}">削除する</a>
                </div>
            </div>
        </div>
    </div>
@endsection

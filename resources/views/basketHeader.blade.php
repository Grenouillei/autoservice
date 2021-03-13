<div class="basket_block">
    <p></p>
    <a href="/basket">Кошик
        <b style="color: dodgerblue;">
            @foreach($product as $ele)
                @if($ele->user_id==\Illuminate\Support\Facades\Auth::user()->id)
                    {{$res}}@break
                @endif
            @endforeach
        </b>
    </a>
</div>

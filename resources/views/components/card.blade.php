@props(['card'])
<article class="col-md-4 col-sm-6 col-xs-12">
    <div class="card card-index">
        <div class="card-body card-index-body">
            <h5 class="card-title card-index-title text-center">{{ $card->title }}</h5>
            <p class="card-text card-index-text text-center">{{ $card->author }}</p>
            <p
                class="card-text card-index-text text-center @if ($card->type == 'share') text-success @else text-danger @endif">
                {{ $card->type }}
            </p>
            <p
                class="card-text card-index-text text-center @if ($card->status == 'approved') text-success @else text-danger @endif">
                {{ $card->status }}
            </p>
            <p class="card-text card-index-text text-center @if ($card->rejection_reason) text-danger @endif">
                {{ $card->rejection_reason }}
            </p>
        </div>
    </div>
</article>
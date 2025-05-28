<button class="btn btn-secondary" id="toggleArchive">Показать архив</button>
<div id="archive" style="display: none;">
    <div class="row">
        @foreach($cards as $card)
            <x-card-table :card-table="$card" />
        @endforeach
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#toggleArchive').click(function() {
            $('#archive').toggle();
            $(this).text($(this).text() === 'Показать архив' ? 'Скрыть архив' : 'Показать архив');
        });
    });
</script>
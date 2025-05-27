<!-- Модальное окно для удаления карточки -->
<div class="modal fade" id="deleteModal{{ $cardTable->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $cardTable->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $cardTable->id }}">Удалить карточку</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Вы уверены, что хотите удалить эту карточку?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                <form action="@if($role === 'admin') {{ route('admin.cards.delete', $cardTable->id) }} @else {{ route('cards.destroy', $cardTable->id) }} @endif" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>

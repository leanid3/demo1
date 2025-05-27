<!-- кастомные уведоления -->
@props(['type' => 'success', 'message'])

<div class="alert alert-{{ $type }}" id="alert-{{ $type }}">
    {{ $message }}
</div>

<script>
  setTimeout(function() {
    document.getElementById('alert-{{ $type }}').style.display = 'none';
    }, 5000); 
</script> 

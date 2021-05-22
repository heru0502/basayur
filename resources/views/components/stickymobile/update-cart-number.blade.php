@push('javascript')
<script>
    Livewire.on('updateCartNumber', total_item => {
        document.getElementById('total_item').innerHTML = total_item === 0 ? '' : total_item;
    });
</script>
@endpush
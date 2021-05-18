@push('stylesheet')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" />
@endpush

@push('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous"></script>

    @if (session('success'))
        <script>
            let message = '';        
            if ("{{ session('success') }}" === 'store') {
                message = 'Data telah tersimpan.' 
            } 
            else if ("{{ session('success') }}" === 'update') {
                message = 'Data telah diperbarui.' 
            } 
            else if ("{{ session('success') }}" === 'destroy') {
                message = 'Data telah terhapus.' 
            }
            else if ("{{ session('success') }}" === 'mark_all_as_read') {
                message = 'Semua notifikasi telah ditandai sudah dibaca.' 
            }
            else if ("{{ session('success') }}" === 'import') {
                message = 'Data telah berhasil di import.' 
            }

            iziToast.success({
                title: 'Berhasil!',
                message: message,
                position: 'bottomRight',
                transitionIn: 'bounceInUp'
            });        
        </script>

    @elseif (session('warning'))
        <script>
            iziToast.warning({
                title: 'Hey',
                message: 'What would you like to add?',
                position: 'topRight'
            });
        </script>
    @endif
@endpush
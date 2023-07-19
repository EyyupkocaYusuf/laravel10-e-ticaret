<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('#upload-btn').on('click', function() {
        // Dosya yükleme öğesini seç
        var fileInput = $('#image')[0];

        // Dosya yüklendiğinde tetiklenecek olay dinleyicisi
        $(fileInput).on('change', function() {
            var file = fileInput.files[0]; // İlk seçilen dosyayı al

            if (file) {
                // Dosyanın adını ve boyutunu al
                var fileName = file.name;
                var fileSize = file.size;

                // İstenirse dosyanın türünü de alabilirsiniz
                var fileType = file.type;

                // Dosyanın bilgilerini konsolda göster
                console.log('Dosya Adı:', fileName);
                console.log('Dosya Boyutu (byte):', fileSize);
                console.log('Dosya Türü:', fileType);
            } else {
                // Eğer dosya seçilmediyse uyarı ver
                console.log('Dosya seçilmedi.');
            }
        });
    });
});
</script>



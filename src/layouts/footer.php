<!-- Instascan Library untuk pemindaian QR Code -->
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>
  // Inisialisasi Instascan
  const scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

  // Mengaktifkan pemindaian QR code
  scanner.addListener('scan', function (content) {
    document.getElementById('qr_code').value = content; // Set hasil scan ke input qr_code
  });

  // Memulai pemindaian saat kamera siap
  Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
      console.log('Kamera yang terdeteksi:', cameras); // Log kamera yang terdeteksi
      scanner.start(cameras[0]); // Menggunakan kamera pertama yang tersedia
    } else {
      console.error('Tidak ada kamera yang terdeteksi.');
    }
  }).catch(function (e) {
    console.error('Gagal mendapatkan kamera:', e);
  });
</script>


</body>

</html>
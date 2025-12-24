document.addEventListener('DOMContentLoaded', function () {
    const toastElement = document.getElementById('toast-success');
    const closeButton = document.getElementById('btn-close-toats');

    if (toastElement) {
        // Fungsi untuk menyembunyikan toast
        const hideToast = () => {
            toastElement.classList.add('hidden');
        };

        // Otomatis menyembunyikan toast setelah 5 detik
        setTimeout(() => {
            hideToast();
        }, 5000); // 5000 milidetik = 5 detik

        // Menambahkan event listener untuk tombol tutup
        closeButton.addEventListener('click', () => {
            hideToast();
        });
    }
});
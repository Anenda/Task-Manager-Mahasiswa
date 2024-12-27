// Pastikan `deadline` sudah didefinisikan
if (typeof deadline !== 'undefined') {
    const intervals = [3600, 1800, 900]; // Dalam detik: 1 jam, 30 menit, 15 menit
    const messages = {
        3600: "Deadline tinggal 1 jam lagi!",
        1800: "Deadline tinggal 30 menit lagi!",
        900: "Deadline tinggal 15 menit lagi!",
    };

    // Fungsi untuk menghitung waktu tersisa
    function checkDeadline() {
        const now = new Date().getTime();
        const timeLeft = Math.floor((deadline - now) / 1000); // Hitung sisa waktu dalam detik

        intervals.forEach(interval => {
            if (timeLeft === interval) {
                alert(messages[interval]);
            }
        });

        if (timeLeft <= 0) {
            clearInterval(timer); // Hentikan timer jika waktu habis
            alert("Deadline sudah lewat!");
        }
    }

    // Jalankan pengecekan setiap detik
    const timer = setInterval(checkDeadline, 1000);
}

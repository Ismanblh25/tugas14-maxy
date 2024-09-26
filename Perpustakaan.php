<?php
// Daftar buku dalam perpustakaan
$daftarBuku = ["Pemrograman PHP", "Belajar JavaScript", "Desain Web dengan HTML & CSS", "Algoritma dan Struktur Data", "Pengantar Basis Data"];

// Fungsi untuk menampilkan daftar buku
function tampilkanDaftarBuku($buku) {
    if (empty($buku)) {
        echo "Tidak ada buku yang tersedia saat ini.\n";
    } else {
        echo "Daftar Buku Tersedia:\n";
        foreach ($buku as $index => $judulBuku) {
            echo ($index + 1) . ". " . $judulBuku . "\n";
        }
    }
}

// Fungsi untuk meminjam buku
function pinjamBuku(&$buku) {
    tampilkanDaftarBuku($buku);
    if (!empty($buku)) {
        echo "Masukkan nomor buku yang ingin dipinjam: ";
        $nomor = trim(fgets(STDIN)) - 1;

        if (isset($buku[$nomor])) {
            echo "Anda meminjam buku: " . $buku[$nomor] . "\n";
            unset($buku[$nomor]); // Hapus buku dari daftar
            $buku = array_values($buku); // Mengurutkan kembali array
        } else {
            echo "Nomor buku tidak valid!\n";
        }
    }
}

// Fungsi untuk mengembalikan buku
function kembalikanBuku(&$buku, &$bukuPinjaman) {
    if (empty($bukuPinjaman)) {
        echo "Tidak ada buku yang dipinjam saat ini.\n";
        return;
    }

    echo "Daftar Buku yang Dipinjam:\n";
    foreach ($bukuPinjaman as $index => $judulBuku) {
        echo ($index + 1) . ". " . $judulBuku . "\n";
    }

    echo "Masukkan nomor buku yang ingin dikembalikan: ";
    $nomor = trim(fgets(STDIN)) - 1;

    if (isset($bukuPinjaman[$nomor])) {
        echo "Anda mengembalikan buku: " . $bukuPinjaman[$nomor] . "\n";
        $buku[] = $bukuPinjaman[$nomor]; // Tambahkan buku kembali ke daftar
        unset($bukuPinjaman[$nomor]); // Hapus buku dari daftar pinjaman
        $bukuPinjaman = array_values($bukuPinjaman); // Mengurutkan kembali array
    } else {
        echo "Nomor buku tidak valid!\n";
    }
}

// Daftar buku yang dipinjam
$bukuPinjaman = [];

// Menu sistem perpustakaan
do {
    echo "\n=== Sistem Manajemen Perpustakaan ===\n";
    echo "1. Lihat Daftar Buku\n";
    echo "2. Pinjam Buku\n";
    echo "3. Kembalikan Buku\n";
    echo "4. Keluar\n";
    echo "Pilih menu (1-4): ";
    $pilihan = trim(fgets(STDIN));

    switch ($pilihan) {
        case 1:
            tampilkanDaftarBuku($daftarBuku);
            break;
        case 2:
            pinjamBuku($daftarBuku);
            $bukuPinjaman[] = $judulBuku ?? null; // Simpan buku yang dipinjam
            break;
        case 3:
            kembalikanBuku($daftarBuku, $bukuPinjaman);
            break;
        case 4:
            echo "Terima kasih telah menggunakan Sistem Manajemen Perpustakaan.\n";
            break;
        default:
            echo "Pilihan tidak valid, coba lagi.\n";
    }
} while ($pilihan != 4);

?>

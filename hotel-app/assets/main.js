// Fungsi untuk mengonfirmasi penghapusan pengguna
function konfirmasiHapus(id) {
    const konfirmasi = confirm("Apakah Anda yakin ingin menghapus pengguna ini?");
    if (konfirmasi) {
        window.location.href = "hapus_pengguna.php?id=" + id;
    }
}

// Fungsi untuk menyaring daftar pengguna berdasarkan nama
function filterPengguna() {
    const input = document.getElementById('filter-nama');
    const filter = input.value.toUpperCase();
    const table = document.getElementById("userTable");
    const trs = table.getElementsByTagName('tr');

    for (let i = 1; i < trs.length; i++) {
        const td = trs[i].getElementsByTagName("td")[1]; // Nama pengguna berada di kolom kedua
        if (td) {
            const txtValue = td.textContent || td.innerText;
            trs[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
        }
    }
}

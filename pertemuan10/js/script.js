const keyword = document.querySelector("#keyword"); // Fixed typo
const tombolCari = document.getElementById("tombol-cari");
const container = document.getElementById("container");

// tambahkan event ketika keyword di tulis
keyword.addEventListener("keyup", function () {
  // buat object ajax
  const xhr = new XMLHttpRequest();

  // jalankan fungsi ini ketika request berhasil
  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      container.innerHTML = xhr.responseText;
    }
  };

  // eksekusi ajax
  xhr.open("GET", "ajax/mahasiswa.php?keyword=" + keyword.value, true);
  xhr.send();
}); // Closed function properly

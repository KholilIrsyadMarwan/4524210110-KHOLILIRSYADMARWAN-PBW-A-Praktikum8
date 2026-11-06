# 📚 AuthBook - Library Admin System

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Filament](https://img.shields.io/badge/Filament-3-FDAE4B?style=for-the-badge&logo=laravel&logoColor=black)](https://filamentphp.com)
[![SQLite](https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white)](https://www.sqlite.org)

**AuthBook** adalah aplikasi manajemen administrasi perpustakaan berbasis web yang dikembangkan menggunakan **Laravel 12** dan **Filament 3**. Aplikasi ini dirancang untuk memudahkan staf internal dan admin dalam mengelola data buku, penulis, serta kategori buku dengan sistem otorisasi berbasis peran (Role-Based Access Control).

---

## 👨‍🎓 Informasi Mahasiswa & Praktikum

* **Nama:** Kholil Irsyad Marwan
* **NPM:** 4524210110
* **Mata Kuliah:** Pemrograman Berbasis Web (PBW) - Kelas A
* **Tugas:** Praktikum 8
* **Program Studi:** Teknik Informatika, Universitas Pancasila
* **Dosen Pengampu:** Bambang Riono Arsad, S.Kom., MMSI

---

## ✨ Fitur Utama

- 📖 **Manajemen Buku (CRUD Buku):** Pencarian (*searchable*), penyaringan (*filter* status/penulis), pengurutan data (*sortable*), pengunggahan gambar sampul (JPEG/PNG/WebP maks 2MB), dan pembaruan massal.
- ✍️ **Manajemen Penulis & Kategori:** Pengelolaan data master penulis dan kategori buku secara fleksibel, termasuk fitur *Create Option Form* langsung dari form buku.
- 🛡️ **Sistem Hak Akses (Role Policy):** Pengaturan hak akses bertingkat melalui Laravel Policy:
  - 👑 **Admin:** Akses penuh (View, Create, Edit, Delete, Force Delete).
  - 🧑‍💼 **Staff:** Akses operasional (View, Create, Edit).
  - 👁️ **Viewer:** Akses baca saja (View Only).
- 📊 **Interactive Dashboard Widgets:** 
  - **LibraryStatsOverview:** Menampilkan statistik total buku, penulis, dan buku yang tersedia/dipinjam.
  - **BookStatusChart:** Grafik donat yang membandingkan persentase buku *Available* vs *Borrowed*.

---

## 🏗️ Penjelasan Arsitektur & Relasi Basis Data

Aplikasi ini mengimplementasikan skema relasi basis data *Eloquent*:
1. **`authors` ➡️ `books` ($1 : N$):** Satu penulis dapat memiliki banyak buku.
2. **`books` ↔️ `categories` ($N : M$):** Satu buku dapat memiliki banyak kategori, dan satu kategori menampung banyak buku (dihubungkan melalui tabel pivot `category_book`).
3. **`users`:** Mengelola otentikasi serta otorisasi melalui kolom `role`.

```dbml
// Database Schema: AuthBook

Table users {
  id bigint [pk, increment]
  name varchar
  email varchar [unique]
  password varchar
  role varchar [note: 'admin / staff / viewer']
  created_at timestamp
  updated_at timestamp
}

Table authors {
  id bigint [pk, increment]
  name varchar
  bio text
  created_at timestamp
  updated_at timestamp
}

Table books {
  id bigint [pk, increment]
  author_id bigint [ref: > authors.id]
  title varchar
  description text
  cover_image varchar
  status varchar
  created_at timestamp
  updated_at timestamp
}

Table categories {
  id bigint [pk, increment]
  name varchar
  slug varchar [unique]
  created_at timestamp
  updated_at timestamp
}

Table category_book {
  category_id bigint [ref: > categories.id]
  book_id bigint [ref: > books.id]

  Indexes {
    (category_id, book_id) [pk]
  }
}

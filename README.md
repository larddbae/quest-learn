<div align="center">

<br/>

```
 ██████╗ ██╗   ██╗███████╗███████╗████████╗
██╔═══██╗██║   ██║██╔════╝██╔════╝╚══██╔══╝
██║   ██║██║   ██║█████╗  ███████╗   ██║   
██║▄▄ ██║██║   ██║██╔══╝  ╚════██║   ██║   
╚██████╔╝╚██████╔╝███████╗███████║   ██║   
 ╚══▀▀═╝  ╚═════╝ ╚══════╝╚══════╝   ╚═╝   
██╗     ███████╗ █████╗ ██████╗ ███╗   ██╗
██║     ██╔════╝██╔══██╗██╔══██╗████╗  ██║
██║     █████╗  ███████║██████╔╝██╔██╗ ██║
██║     ██╔══╝  ██╔══██║██╔══██╗██║╚██╗██║
███████╗███████╗██║  ██║██║  ██║██║ ╚████║
╚══════╝╚══════╝╚═╝  ╚═╝╚═╝  ╚═╝╚═╝  ╚═══╝
```

### ⚔️ *Level Up Your Learning. Conquer Knowledge. Earn Glory.* ⚔️

<br/>

![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-4.x-06B6D4?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-8.x-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-22c55e?style=for-the-badge)

<br/>

> **QuestLearn** adalah platform pembelajaran berbasis **gamifikasi RPG** yang mengubah proses belajar menjadi petualangan epik.  
> Siswa bertualang melewati **Quest**, mengumpulkan **XP**, menaiki **Level**, meraih **Badge**, dan bersaing di **Leaderboard** — sementara guru berperan sebagai **Game Master** yang merancang dungeon ilmu pengetahuan.

<br/>

[🎮 Demo Live](#-demo) · [📸 Screenshot](#-screenshot) · [🚀 Mulai Cepat](#-instalasi) · [📖 Dokumentasi](#-fitur-utama) · [🤝 Kontribusi](#-kontribusi)

</div>

---

## 🗺️ Daftar Isi

- [🌟 Fitur Utama](#-fitur-utama)
- [🏛️ Arsitektur Sistem](#️-arsitektur-sistem)
- [⚙️ Tech Stack](#️-tech-stack)
- [🚀 Instalasi](#-instalasi)
- [🎮 Cara Penggunaan](#-cara-penggunaan)
- [📂 Struktur Proyek](#-struktur-proyek)
- [🗄️ Skema Database](#️-skema-database)
- [🤝 Kontribusi](#-kontribusi)
- [📜 Lisensi](#-lisensi)

---

## 🌟 Fitur Utama

<table>
<tr>
<td width="50%">

### 🧙 Untuk Siswa (Apprentice)
- **⚔️ Quest Board** — Jalur belajar berurutan dengan sistem *prerequisite*
- **📜 Materi Interaktif** — Konten belajar kaya teks & media
- **🎯 Quiz Arena** — Kuis dinamis dengan timer & skor real-time
- **📈 XP & Level System** — Sistem pengalaman progresif (formula: `Level × 100 × 1.5`)
- **🏅 Badge & Achievement** — Penghargaan untuk pencapaian spesial
- **🏆 Leaderboard** — Papan peringkat persaingan antar anggota Guild
- **🔖 Bookmark** — Simpan materi favorit untuk review cepat
- **👤 Profil RPG** — Kartu karakter dengan avatar, rank, & statistik lengkap

</td>
<td width="50%">

### 👨‍🏫 Untuk Guru (Game Master)
- **🏰 Guild Management** — Kelola kelas dengan kode unik 6-karakter
- **📚 Subject Creator** — Buat mata pelajaran & kurikulum quest
- **✍️ Quest Builder** — Rancang misi belajar dengan XP reward kustom
- **📋 Material Editor** — Unggah & kelola konten materi belajar
- **❓ Quiz Designer** — Buat kuis dengan multiple pilihan jawaban
- **📊 Progress Dashboard** — Pantau perkembangan setiap siswa
- **🎖️ Badge Configurator** — Desain & distribusikan badge penghargaan
- **👥 Multi-Guild Support** — Kelola banyak kelas sekaligus

</td>
</tr>
</table>

---

## 🏛️ Arsitektur Sistem

```
QuestLearn Ecosystem
══════════════════════════════════════════════════════

  🏰 GUILD (Classroom)
  └── 📖 SUBJECT (Mata Pelajaran)
       └── ⚔️  QUEST (Misi Belajar)
            ├── 📜 MATERIAL (Halaman Konten 1:1)
            └── 🎯 QUIZ (Soal-soal)

  👤 USER
  ├── 🧙 Teacher (Game Master) → owns Guilds, creates content
  └── 🧝 Student (Apprentice)  → joins Guilds, completes Quests
       ├── 📈 UserProgress     → tracks Quest & Quiz completion
       ├── 🏅 Badge            → earned achievements (M:N)
       └── 🔖 Bookmark         → saved Materials (1:N)

Sequential Learning Flow:
  Quest 1 ──[COMPLETED]──► Quest 2 ──[LOCKED]──► Quest 3
  (Always Unlocked)         (Prerequisite Met)     (Locked)
```

### 🔒 Sistem Sequential Learning

QuestLearn menerapkan filosofi **Prerequisite Learning** — siswa *harus* menyelesaikan Quest sebelumnya sebelum dapat mengakses Quest berikutnya. Ini memastikan penguasaan materi secara sistematis dari dasar hingga mahir.

---

## ⚙️ Tech Stack

| Lapisan | Teknologi | Versi | Fungsi |
|---------|-----------|-------|--------|
| **Backend** | Laravel | `^13.0` | Framework PHP utama, routing, ORM |
| **Runtime** | PHP | `^8.3` | Server-side scripting |
| **Frontend CSS** | Tailwind CSS | `^4.0` | Utility-first styling |
| **Frontend JS** | Alpine.js | `^3.15` | Reactive UI ringan |
| **Build Tool** | Vite | `^8.0` | Asset bundling & HMR |
| **Database** | MySQL / SQLite | — | Penyimpanan data utama |
| **Auth** | Laravel Breeze | built-in | Autentikasi multi-role |
| **Queue** | Laravel Queue | built-in | Notifikasi async |
| **Testing** | PHPUnit | `^12.5` | Unit & feature testing |

---

## 🚀 Instalasi

### Prasyarat

Pastikan sistem kamu sudah terinstal:

- **PHP** `>= 8.3` dengan ekstensi: `pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`
- **Composer** `>= 2.x`
- **Node.js** `>= 20.x` & **npm** `>= 10.x`
- **MySQL** `>= 8.0` atau **SQLite** (untuk development)

---

### ⚡ Quick Start (Satu Perintah)

```bash
git clone https://github.com/larddbae/quest-learn.git
cd quest-learn
composer run setup
```

Perintah `composer run setup` akan otomatis:
1. Menginstal semua dependensi PHP & Node.js
2. Membuat file `.env` dari template
3. Men-generate `APP_KEY`
4. Menjalankan semua migrasi database

---

### 🔧 Instalasi Manual (Step-by-step)

```bash
# 1. Clone repositori
git clone https://github.com/larddbae/quest-learn.git
cd quest-learn

# 2. Instal dependensi PHP
composer install

# 3. Salin dan konfigurasi environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di file .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=questlearn
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Jalankan migrasi & seeder
php artisan migrate --seed

# 6. Instal dependensi Node.js
npm install

# 7. Buat symlink storage untuk file upload
php artisan storage:link
```

---

### ▶️ Menjalankan Aplikasi

```bash
# Mode Development (menjalankan semua service sekaligus)
composer run dev

# Atau jalankan secara manual:
php artisan serve          # Web server (http://localhost:8000)
npm run dev                # Vite HMR server
php artisan queue:listen   # Queue worker (untuk notifikasi)
```

Buka **http://localhost:8000** di browser kamu. 🚀

---

### 🔑 Akun Default (Setelah Seeding)

| Role | Email | Password |
|------|-------|----------|
| 🧙 Teacher | `teacher@questlearn.id` | `password` |
| 🧝 Student | `student@questlearn.id` | `password` |

> **⚠️ Catatan Keamanan:** Ganti password ini sebelum deploy ke production!

---

## 🎮 Cara Penggunaan

### Alur Guru (Game Master)
```
Login → Dashboard → Buat Guild (Kelas) → Bagikan Join Code
     → Tambah Subject → Buat Quest → Unggah Material → Buat Quiz
     → Pantau Progress Siswa di Dashboard
```

### Alur Siswa (Apprentice)
```
Register → Pilih Avatar → Join Guild (masukkan Join Code)
        → Quest Board → Baca Material → Ikuti Quiz Arena
        → Kumpulkan XP → Naik Level → Raih Badge
        → Bersaing di Leaderboard
```

---

## 📂 Struktur Proyek

```
quest-learn/
├── 📁 app/
│   ├── 📁 Http/
│   │   ├── Controllers/         # Request handling & business logic
│   │   └── Middleware/          # Auth guards & role checks
│   ├── 📁 Models/               # Eloquent ORM models
│   │   ├── User.php             # 👤 Siswa & Guru (XP, Level, Badges)
│   │   ├── Classroom.php        # 🏰 Guild dengan auto-join-code
│   │   ├── Subject.php          # 📖 Mata pelajaran dalam Guild
│   │   ├── Quest.php            # ⚔️  Misi belajar (sequential unlock)
│   │   ├── Material.php         # 📜 Konten materi (1:1 per Quest)
│   │   ├── Quiz.php             # 🎯 Soal-soal kuis
│   │   ├── UserProgress.php     # 📈 Rekam jejak belajar siswa
│   │   ├── Badge.php            # 🏅 Sistem penghargaan
│   │   └── Bookmark.php         # 🔖 Materi tersimpan
│   ├── 📁 Notifications/        # Notifikasi sistem (badge, level-up)
│   └── 📁 Services/             # Business logic services
├── 📁 resources/
│   ├── 📁 views/
│   │   ├── admin/               # 🧙 Panel Guru (Game Master)
│   │   │   ├── dashboard        # Analytics & statistik kelas
│   │   │   ├── classrooms/      # Manajemen Guild
│   │   │   ├── subjects/        # Manajemen mata pelajaran
│   │   │   ├── quests/          # Quest builder
│   │   │   ├── materials/       # Content editor
│   │   │   ├── quizzes/         # Quiz designer
│   │   │   └── badges/          # Badge configurator
│   │   ├── student/             # 🧝 Portal Siswa (Apprentice)
│   │   │   ├── dashboard        # Character HUD & Active Quests
│   │   │   ├── quest-board      # Peta misi terkunci/terbuka
│   │   │   ├── quiz-arena       # Ruang kuis interaktif
│   │   │   ├── leaderboard      # Papan peringkat Guild
│   │   │   └── profile          # Kartu karakter RPG
│   │   ├── components/          # Blade components reusable
│   │   │   ├── pixel-card       # Card dengan pixel-art style
│   │   │   ├── pixel-button     # Button dengan variasi tema
│   │   │   └── xp-bar           # Progress bar XP dinamis
│   │   └── layouts/             # Layout utama (student/admin)
│   └── 📁 js/
│       └── app.js               # Alpine.js entrypoint
├── 📁 database/
│   ├── migrations/              # Skema database versioned
│   ├── seeders/                 # Data sample untuk development
│   └── factories/               # Model factories untuk testing
├── 📁 routes/
│   └── web.php                  # Definisi semua route aplikasi
└── 📁 PRD/                      # Product Requirements Document
```

---

## 🗄️ Skema Database

```
┌─────────────────┐    ┌──────────────────┐    ┌──────────────────┐
│     users       │    │   classrooms     │    │    subjects      │
├─────────────────┤    ├──────────────────┤    ├──────────────────┤
│ id              │    │ id               │    │ id               │
│ name            │◄───┤ teacher_id (FK)  │◄───┤ classroom_id(FK) │
│ email           │    │ name             │    │ name             │
│ role            │    │ join_code        │    │ description      │
│ xp              │    │ description      │    └────────┬─────────┘
│ level           │    │ visibility       │             │
│ rank            │    └──────────────────┘             │
│ avatar          │                             ┌────────▼─────────┐
│ bio             │    ┌──────────────────┐     │     quests       │
└────────┬────────┘    │ classroom_user   │     ├──────────────────┤
         │             │ (pivot M:N)      │     │ id               │
         │    ┌────────┤ classroom_id     │     │ subject_id (FK)  │
         │    │        │ user_id          │     │ title            │
         │    │        └──────────────────┘     │ description      │
         │    │                                 │ order            │
         │    │        ┌──────────────────┐     │ xp_reward        │
         │    │        │  user_progress   │     └────────┬─────────┘
         │    │        ├──────────────────┤              │
         │    │        │ user_id (FK)  ◄──┘              │
         │    └───────►│ quest_id (FK)    │◄─────────────┘
         │             │ score            │
         │             │ total_questions  │    ┌──────────────────┐
         │             │ is_completed     │    │    materials     │
         │             └──────────────────┘    ├──────────────────┤
         │                                     │ id               │
         │             ┌──────────────────┐    │ quest_id (FK)    │
         │             │    badge_user    │    │ content          │
         │             │    (pivot M:N)  │    └──────────────────┘
         └────────────►│ user_id          │
                       │ badge_id         │    ┌──────────────────┐
                       │ awarded_at       │    │     quizzes      │
                       └──────────────────┘    ├──────────────────┤
                                               │ id               │
                                               │ quest_id (FK)    │
                                               │ question         │
                                               │ options (JSON)   │
                                               │ correct_answer   │
                                               └──────────────────┘
```

---

## 🧪 Testing

```bash
# Jalankan semua test
composer run test

# Atau menggunakan Artisan langsung
php artisan test

# Jalankan test spesifik
php artisan test --filter=UserProgressTest

# Jalankan dengan coverage report
php artisan test --coverage
```

---

## 🤝 Kontribusi

Kontribusi sangat disambut! Berikut cara berkontribusi:

1. **Fork** repositori ini
2. **Buat branch** fitur baru: `git checkout -b feature/nama-fitur-kamu`
3. **Commit** perubahan: `git commit -m 'feat: tambah fitur keren'`
4. **Push** ke branch: `git push origin feature/nama-fitur-kamu`
5. **Buat Pull Request** dan jelaskan perubahanmu

### Panduan Commit

Gunakan [Conventional Commits](https://www.conventionalcommits.org/):

```
feat:     Fitur baru
fix:      Perbaikan bug
docs:     Perubahan dokumentasi
style:    Perubahan formatting (tidak mengubah logika)
refactor: Refactoring kode
test:     Menambah atau memperbaiki test
chore:    Pembaruan build tools, dependencies
```

---

## 📜 Lisensi

Proyek ini dilisensikan di bawah **MIT License** — lihat file [LICENSE](LICENSE) untuk detail lengkap.

---

<div align="center">

### ⚔️ *"The journey of a thousand quests begins with a single click."* ⚔️

<br/>

Dibuat dengan ❤️ menggunakan **Laravel** + **Tailwind CSS** + **Alpine.js**

<br/>

[![Made with Laravel](https://img.shields.io/badge/Made%20with-Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP 8.3](https://img.shields.io/badge/PHP-8.3-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)

</div>

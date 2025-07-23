# Filament Employee Management (CodeWithTony)

A Laravel 12-based employee management dashboard built using **Filament**, **Livewire**, **Chart.js**, and **Flowframe UI**.  
This project was developed by following a tutorial series by [Tony Xhepa](https://www.youtube.com/@tonyxhepaofficial), with personal adjustments and enhancements.

---

## 📸 Screenshots

*(Add screenshots here if available)*

---

## 🚀 Features

- Employee data management (Create, Read, Update, Delete)
- Filament Admin Panel for intuitive UI
- Charts and statistics using Chart.js
- Clean and responsive design with Flowframe
- Built with Livewire and Laravel 12

---

## 🧰 Tech Stack

- **PHP** 8.x
- **Laravel** 12.x
- **Filament** v3
- **Livewire**
- **Chart.js**
- **Flowframe UI**
- **Sqlite** 

---

## ⚙️ Installation Guide

Follow these steps to install and run the project locally:

### 1. Clone Repository
```
git clone https://github.com/justucok/filament-codewithtony.git
cd filament-codewithtony
```

### 2. Install PHP & Node.js Dependencies
```
composer install
npm install && npm run dev
```

### 3. Configure Environment File
```
cp .env.example .env
php artisan key:generate
```

Edit file .env dan sesuaikan dengan konfigurasi database:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=filament_employee
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Run Migrations
```
php artisan migrate
```

### 5. (Optional) Seed Database
```
php artisan db:seed
```

### 6. Serve Application
```
php artisan serve
```
Buka browser dan akses: http://localhost:8000

👨‍💻 Author
Developed by Just Ucok
Tutorial Credit: Tony Xhepa (CodeWithTony)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

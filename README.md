# 🚀 Laravel Project Setup Guide

Welcome to the **Laravel Blog Project**! 

---

## 🎥 Demo Video
[![Watch the Demo](https://img.youtube.com/vi/VeNfHj6MhgA/maxresdefault.jpg)](https://www.youtube.com/watch?v=VeNfHj6MhgA&t=9025s)
👉 [Watch the Full Demo on YouTube](https://www.youtube.com/watch?v=VeNfHj6MhgA&t=9025s&ab_channel=TraversyMedia)

## 📸 Screenshots


### 🏠 Home Page
![Home Page](https://usairticket.com/wp-content/uploads/2025/07/screencapture-127-0-0-1-8000-2025-07-29-12_43_06.png)

### 🚀 Detail Page
![Home Page](https://usairticket.com/wp-content/uploads/2025/07/screencapture-127-0-0-1-8000-blogposts-100-2025-07-29-12_43_15.png)

### 🛠️ Admin Panel
![Admin Panel](https://usairticket.com/wp-content/uploads/2025/07/screencapture-127-0-0-1-8000-admin-blogposts-2025-07-29-12_41_29.png)

---

## 🚦 Installation & Setup

### 1️⃣ Clone the Repository

```bash
git clone [https://github.com/your-username/your-laravel-project.git](https://github.com/sajjad-cse-ku/taskco-digital-laravel.git)
cd your-laravel-project
````

### 2️⃣ Install Dependencies

```bash
composer install
```

### 3️⃣ Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit the `.env` file and set your **DB credentials**:

```env
DB_DATABASE=your_db
DB_USERNAME=root
DB_PASSWORD=root
```

### 4️⃣ Run Migrations & Seeders

```bash
php artisan migrate:fresh --seed
```

### 5️⃣ Start the Development Server

```bash
php artisan serve
```

Visit your app at [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## ✅ Admin Login (optional)
👉 [http://127.0.0.1:8000/admin/login](http://127.0.0.1:8000/admin/login)
```txt
Email: superadmin@gmail.com
Password: password
```

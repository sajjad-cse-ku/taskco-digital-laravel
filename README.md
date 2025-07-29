# 🚀 Laravel Project Setup Guide

Welcome to the **Laravel Blog Project**! 

---

## 🎥 Demo Video

👉 [Watch the Full Demo on YouTube](https://www.youtube.com/watch?v=your-video-id)

## 📸 Screenshots

### 🏠 Home Page
![Home Page](https://prnt.sc/19fFMgoSRnUz)

### 🏠 Detail Page
![Home Page](https://prnt.sc/VBEJgzfCrIs_)

### 🛠️ Admin Panel
![Admin Panel](https://yourdomain.com/screenshots/admin.png)

---

## 🚦 Installation & Setup

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/your-username/your-laravel-project.git
cd your-laravel-project
````

### 2️⃣ Install Dependencies

```bash
composer install
npm install && npm run dev
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

# 🎮 Rock Paper Scissors Game (Dockerized)

## 📝 Project Overview
This is a **full-stack Rock Paper Scissors game** built with:
- **Backend:** Laravel (PHP)
- **Frontend:** Next.js (React + TypeScript)
- **Containerized with Docker**

## 🚀 How to Run the Project Using Docker

### **1️⃣ Prerequisites**
Before you start, ensure you have the following installed:

- **Docker & Docker Compose**  
  - Download: [https://www.docker.com/get-started](https://www.docker.com/get-started)  
  - Verify installation:  
    ```bash
    docker --version
    docker-compose --version
    ```
- **Git**
  - Download: [https://git-scm.com/downloads](https://git-scm.com/downloads)
  - Verify installation:  
    ```bash
    git --version
    ```

---

### **2️⃣ Clone the Repositories**

#### **Step 1: Create a Project Directory**
1. Open **Visual Studio Code** (or your preferred IDE).  
2. Create a new folder and open it.

#### **Step 2: Clone the Backend Repository**
```bash
git clone https://github.com/GelacioCode/rock-paper-scissors.git backend
cd backend
```

#### **Step 3: Install Backend Dependencies**
Make sure you have **Composer** installed:  
- Download from: [https://getcomposer.org/download/](https://getcomposer.org/download/)
- Verify installation:
  ```bash
  composer --version
  ```

Once Composer is installed, run:
```bash
composer install
```

#### **Step 4: Set Up Backend Configuration**
```bash
cp .env.example .env
php artisan key:generate
```

#### **Step 5: Clone the Frontend Repository**
Move back to the root folder:
```bash
cd ..
git clone https://github.com/GelacioCode/rock-paper-scissors-frontend.git frontend
cd frontend
```

#### **Step 6: Install Frontend Dependencies**
```bash
npm install
```

---

### **3️⃣ Run the Project with Docker**
Navigate back to the root folder containing both backend and frontend repositories, then start the containers:

```bash
docker-compose up --build
```

This will start both the **Laravel backend** and the **Next.js frontend** in their respective Docker containers.

---

### **4️⃣ Access the Application**
- **Frontend:** [http://localhost:3000](http://localhost:3000)  
- **Backend API:** [http://localhost:8000](http://localhost:8000)

---

### **5️⃣ Stopping the Containers**
To stop the running containers, press `CTRL + C` or run:
```bash
docker-compose down
```

---

### **🎯 Additional Notes**
- If you encounter permission issues with Laravel, run:
  ```bash
  chmod -R 777 storage bootstrap/cache
  ```
- If `docker-compose up --build` fails, try:
  ```bash
  docker-compose down -v
  docker-compose up --build
  ```
- If changes are not reflecting, rebuild the frontend container:
  ```bash
  docker-compose up --build frontend
  ```

---

### ✅ Your project setup should now be complete! 🚀

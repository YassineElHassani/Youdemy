# Youdemy - E-learning Platform

## **Introduction**

Youdemy is a modern e-learning platform designed to bridge the gap between educators and learners. This platform empowers teachers to create and manage courses while allowing students to explore and subscribe to a variety of educational content. With its intuitive design and robust functionality, Youdemy offers an exceptional online learning experience for all users.

---

## **Features**

### **1. User Roles**
- **Admin**:
  - Manage users, courses, categories, and tags.
  - Oversee platform statistics.
- **Teachers**:
  - Create, edit, and manage courses.
  - Track subscriber data and access detailed statistics.
- **Students**:
  - Search and subscribe to courses.
  - Access subscribed course materials.

### **2. Course Management**
- Teachers can create courses, define categories, and add tags for improved organization and discoverability.
- Course editing and deletion functionalities are included.

### **3. Subscription System**
- Students can subscribe to courses.
- Teachers can view the total number of subscribers for their courses.

### **4. Dashboard and Statistics**
- Teachers have access to dashboards showing:
  - Total courses created.
  - Total subscribers.
  - Activity statistics.

### **5. Search and Pagination**
- Users can search for courses by keywords.
- Pagination ensures a seamless browsing experience for large datasets.

### **6. Modern UI Design**
- Fully responsive and visually appealing interface built with TailwindCSS.
- Intuitive navigation for both desktop and mobile users.

---

## **Installation**

### **Prerequisites**
- PHP 8.0 or later.
- MySQL database.
- Composer installed.
- A web server (e.g.,Laragon, Apache, Nginx, or XAMPP).

### **Steps to Set Up**
1. Clone the repository:
   ```bash
   git clone https://github.com//YassineElHassani/Youdemy.git
   ```

2. Navigate to the project directory:
   ```bash
   cd youdemy
   ```

3. Install dependencies:
   ```bash
   composer install
   ```

4. Configure the `.env` file with your database credentials:
   ```bash
   DB_HOST=localhost
   DB_NAME=youdemy
   DB_USER=root
   DB_PASSWORD=yourpassword
   ```

5. Import the database:
   Locate the `database.sql` file.
   Import it into your MySQL server using your preferred tool or via the command line:
   ```bash
   mysql -u root -p youdemy < database.sql
   ```

6. Start the local development server:
   ```bash
   php -S localhost:8000
   ```

7. Access the platform: Open your browser and navigate to:
   ```bash
   http://localhost:8000
   ```

---

## **Project Structure**

   ```bash
├── src/
│   ├── css/
│   ├── img/
│   ├── js/
├── class/
│   ├── Users.php
│   ├── CoursesManager.php
│   ├── TagsManager.php
│   ├── CategoriesManager.php
|   ├── ...
├── config/
│   ├── connection.php
├── platform/
│   ├── manageCourses.php
│   ├── manageUsers.php
│   ├── statistics.php
│   ├── pending.php
|   ├── ...
├── index.php
├── login/
├── register/
├── README.md
|   ├── ...
   ```

---

## **Contributing**

Contributions are welcome! If you have suggestions for new features or improvements:
1. Fork the repository.
2. Create a new branch:
   ```bash
   git checkout -b feature-name
   ```
3. Commit your changes:
   ```bash
   git commit -m "Add your message here"
   ```
4. Push to the branch:
   ```bash
   git checkout -b feature-name
   ```
5. Open a pull request.
   
---

## **Contact**

For any inquiries or support, please contact:
- **Email**: ya.elhassani403@gmail.com
- **GitHub**: https://github.com/YassineElHassani

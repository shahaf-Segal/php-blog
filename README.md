# PHP Blog

A simple blog application aimed at learning the basics of PHP full-stack development.

## Description
This project is designed to demonstrate the fundamental concepts of PHP full-stack development, including PHP, SQL, Object-Oriented Programming (OOP), and Composer. The blog allows users to view posts, comment on them, and create their own posts with user authorization and routing.

## Features
- **Post Management:** View, create, and manage blog posts.
- **Commenting System:** Comment on posts and engage with other users.
- **User Authorization:** Register, login, and manage user accounts.
- **Routing:** Simple routing system for navigating between pages.

## Technologies Used
- **PHP:** Server-side scripting language.
- **SQL:** Relational database management system.
- **OOP:** Object-Oriented Programming principles.
- **Composer:** Dependency management tool.

## Getting Started

### Installation
1. **Clone the repository:**
   ```sh
   git clone https://github.com/your-username/php-blog.git
   ```
2. **Navigate to the project directory:**
   ```sh
   cd php-blog
   ```
3. **Install dependencies:**
   ```sh
   composer install
   ```
4. **Create a database and import the schema:**
   ```sh
   mysql -u your-username -p your-database-name < schema.sql
   ```
5. **Configure the database connection:**
   Update `config/db.php` with your database credentials.

## Usage
 **Start the development server:**
   ```sh
   php -S localhost:8000 -t public
   ```
- Open your web browser and navigate to [http://localhost:8000](http://localhost:8000).
- Register or login to create and manage your own posts.
- Explore the blog and engage with other users by commenting on posts.


### Code Style
- Follow the **PSR-12** coding standard.
- Use meaningful variable names and comments.
- Keep functions and methods concise and focused.
- Use OOP for ease of read and usability


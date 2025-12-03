# HC IT Solutions - Laravel CMS Backend

A Laravel 12 backend API that powers the HC IT Solutions website, providing CMS functionality for managing content including hero sections, services, blogs, and more.

## Features

- RESTful API endpoints for content management
- Hero sections for different pages
- Services management with features and icons
- Blog system with categories, tags, and relationships
- Settings management for site configuration
- Media library support
- CORS configured for React frontend integration
- Sample data seeders for quick setup

## Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL 8.0 or higher
- XAMPP (recommended for Windows)

## Installation

### 1. Start MySQL Server

Start your MySQL server through XAMPP Control Panel or your preferred method.

### 2. Create Database

Create a new MySQL database named `hc_it_cms`:

```sql
CREATE DATABASE hc_it_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Or use phpMyAdmin to create the database.

### 3. Install Dependencies

```bash
cd hc_it_backend
composer install
```

### 4. Environment Configuration

The `.env` file is already configured with:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hc_it_cms
DB_USERNAME=root
DB_PASSWORD=
```

Update these values if your MySQL configuration is different.

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Migrations

Create all database tables:

```bash
php artisan migrate
```

This will create the following tables:
- `hero_sections` - Hero/banner sections for pages
- `services` - Services offered by the company
- `blog_categories` - Blog categories
- `blog_tags` - Blog tags
- `blogs` - Blog posts
- `blog_blog_tag` - Many-to-many relationship between blogs and tags
- `media_library` - Media files storage
- `settings` - Site settings

### 7. Seed Sample Data

Populate the database with sample data:

```bash
php artisan db:seed
```

This will create:
- 2 hero sections (home and services pages)
- 6 services (Web Development, Mobile App, SEO, UI/UX, E-Commerce, Digital Marketing)
- 3 blog categories (Technology, AI, Integration)
- 4 blog tags (Cloud, Generative AI, Machine Learning, Data Science)
- 3 sample blog posts with relationships

### 8. Start Development Server

```bash
php artisan serve
```

The API will be available at: `http://localhost:8000/api/v1`

## API Documentation

Comprehensive API documentation is available in [API_DOCUMENTATION.md](./API_DOCUMENTATION.md).

### Quick API Examples

#### Get all services
```bash
curl http://localhost:8000/api/v1/services
```

#### Get home hero section
```bash
curl http://localhost:8000/api/v1/hero-sections?page=home
```

#### Get all published blogs
```bash
curl http://localhost:8000/api/v1/blogs
```

#### Get blog categories
```bash
curl http://localhost:8000/api/v1/blog-categories
```

#### Get blog tags
```bash
curl http://localhost:8000/api/v1/blog-tags
```

#### Get single blog by slug
```bash
curl http://localhost:8000/api/v1/blogs/discovery-incommode-earnestly-commanded
```

## Project Structure

```
hc_it_backend/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── Api/
│   │           ├── HeroSectionController.php
│   │           ├── ServiceController.php
│   │           ├── BlogController.php
│   │           └── SettingController.php
│   └── Models/
│       ├── HeroSection.php
│       ├── Service.php
│       ├── Blog.php
│       ├── BlogCategory.php
│       ├── BlogTag.php
│       ├── MediaLibrary.php
│       └── Setting.php
├── database/
│   ├── migrations/
│   │   ├── 2025_11_25_125546_create_hero_sections_table.php
│   │   ├── 2025_11_25_125548_create_services_table.php
│   │   ├── 2025_11_25_125550_create_blog_categories_table.php
│   │   ├── 2025_11_25_125552_create_blog_tags_table.php
│   │   ├── 2025_11_25_125556_create_blogs_table.php
│   │   ├── 2025_11_25_125559_create_blog_blog_tag_table.php
│   │   ├── 2025_11_25_125602_create_media_library_table.php
│   │   └── 2025_11_25_125605_create_settings_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── HeroSectionSeeder.php
│       ├── ServiceSeeder.php
│       └── BlogSeeder.php
├── routes/
│   └── api.php
├── config/
│   └── cors.php
└── bootstrap/
    └── app.php
```

## Database Schema

See [DATABASE_SCHEMA.md](../DATABASE_SCHEMA.md) for the complete database schema documentation.

## Frontend Integration

The backend is designed to work with the React frontend located at `../hc_it_frontend/`.

### CORS Configuration

CORS is already configured to allow requests from all origins. In production, update `config/cors.php` to restrict origins to your specific domain.

### Frontend Setup

1. Navigate to the frontend directory:
   ```bash
   cd ../hc_it_frontend
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. The frontend `.env` file is already configured with:
   ```env
   VITE_API_BASE_URL=http://localhost:8000/api/v1
   ```

4. Start the frontend development server:
   ```bash
   npm run dev
   ```

## API Endpoints

### Public Endpoints (No Authentication Required)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/v1/hero-sections` | Get all hero sections |
| GET | `/api/v1/hero-sections?page=home` | Get hero section for specific page |
| GET | `/api/v1/services` | Get all active services |
| GET | `/api/v1/services/{slug}` | Get single service by slug |
| GET | `/api/v1/blogs` | Get all published blogs (paginated) |
| GET | `/api/v1/blogs?category=technology` | Get blogs by category |
| GET | `/api/v1/blogs?tag=cloud` | Get blogs by tag |
| GET | `/api/v1/blogs?search=keyword` | Search blogs |
| GET | `/api/v1/blogs/{slug}` | Get single blog by slug |
| GET | `/api/v1/blog-categories` | Get all blog categories |
| GET | `/api/v1/blog-tags` | Get all blog tags |
| GET | `/api/v1/settings` | Get all settings |
| GET | `/api/v1/settings?group=general` | Get settings by group |

### Admin Endpoints (Authentication Required - To Be Implemented)

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/v1/admin/hero-sections` | Create new hero section |
| PUT | `/api/v1/admin/hero-sections/{id}` | Update hero section |
| DELETE | `/api/v1/admin/hero-sections/{id}` | Delete hero section |
| POST | `/api/v1/admin/services` | Create new service |
| PUT | `/api/v1/admin/services/{id}` | Update service |
| DELETE | `/api/v1/admin/services/{id}` | Delete service |
| POST | `/api/v1/admin/blogs` | Create new blog |
| PUT | `/api/v1/admin/blogs/{id}` | Update blog |
| DELETE | `/api/v1/admin/blogs/{id}` | Delete blog |
| POST | `/api/v1/admin/settings` | Create/update setting |
| DELETE | `/api/v1/admin/settings/{id}` | Delete setting |

## Testing

### Using cURL

```bash
# Test hero sections
curl http://localhost:8000/api/v1/hero-sections?page=home

# Test services
curl http://localhost:8000/api/v1/services

# Test blogs with filters
curl "http://localhost:8000/api/v1/blogs?category=technology&per_page=5"

# Test single blog
curl http://localhost:8000/api/v1/blogs/discovery-incommode-earnestly-commanded

# Test categories
curl http://localhost:8000/api/v1/blog-categories

# Test tags
curl http://localhost:8000/api/v1/blog-tags
```

### Using Browser

Simply navigate to:
- http://localhost:8000/api/v1/services
- http://localhost:8000/api/v1/blogs
- http://localhost:8000/api/v1/hero-sections?page=home

## Troubleshooting

### MySQL Connection Issues

If you get a connection error:

1. Ensure MySQL is running in XAMPP
2. Check MySQL port (default: 3306)
3. Verify database name, username, and password in `.env`
4. Test MySQL connection:
   ```bash
   php artisan migrate:status
   ```

### Permission Errors

If you encounter permission errors on Windows:

```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### CORS Errors

If the frontend can't connect to the API:

1. Ensure Laravel server is running: `php artisan serve`
2. Check `config/cors.php` settings
3. Verify API base URL in frontend `.env` file
4. Clear browser cache and try again

### Port Already in Use

If port 8000 is already in use:

```bash
# Use a different port
php artisan serve --port=8001
```

Then update the frontend `.env` file:
```env
VITE_API_BASE_URL=http://localhost:8001/api/v1
```

## Next Steps

1. **Start MySQL**: Ensure MySQL server is running
2. **Run Migrations**: `php artisan migrate`
3. **Seed Data**: `php artisan db:seed`
4. **Start Server**: `php artisan serve`
5. **Test APIs**: Visit http://localhost:8000/api/v1/services
6. **Start Frontend**: Navigate to frontend and run `npm run dev`

## Future Enhancements

- [ ] Implement Laravel Sanctum authentication for admin routes
- [ ] Add file upload endpoints for images
- [ ] Create additional migrations for industries, case studies, testimonials, events
- [ ] Add pagination controls for list endpoints
- [ ] Implement caching for frequently accessed data
- [ ] Add API rate limiting
- [ ] Create comprehensive unit and feature tests
- [ ] Add API versioning strategy
- [ ] Implement webhook notifications for content updates
- [ ] Create Postman/Insomnia collection

## Support

For issues or questions:
1. Check the [API_DOCUMENTATION.md](./API_DOCUMENTATION.md)
2. Review the [DATABASE_SCHEMA.md](../DATABASE_SCHEMA.md)
3. Check Laravel logs: `storage/logs/laravel.log`

## Tech Stack

- **Framework**: Laravel 12
- **Database**: MySQL 8.0+
- **Authentication**: Laravel Sanctum (to be implemented)
- **API**: RESTful architecture
- **CORS**: Configured for React frontend

## License

Proprietary - HC IT Solutions

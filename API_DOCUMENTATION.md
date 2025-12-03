# HC IT Solutions - API Documentation

## Base URL
```
http://localhost:8000/api/v1
```

## Authentication
- Public endpoints: No authentication required
- Admin endpoints: Require Laravel Sanctum token (to be implemented)

## Response Format
All API responses follow this structure:
```json
{
  "success": true,
  "data": {...},
  "message": "Optional message"
}
```

Error responses:
```json
{
  "success": false,
  "message": "Error message",
  "errors": {...}
}
```

---

## Public Endpoints

### Hero Sections

#### Get Hero Sections
Retrieve hero/banner sections for pages.

**Endpoint:** `GET /hero-sections`

**Query Parameters:**
- `page` (optional): Filter by page name (e.g., 'home', 'services')

**Example Request:**
```bash
curl http://localhost:8000/api/v1/hero-sections?page=home
```

**Example Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "page": "home",
      "title": "Transforming Businesses Through Technology",
      "subtitle": "Enterprise Digital Solutions",
      "description": "Introducing cutting-edge technology into enterprises...",
      "button_text": "Get Started",
      "button_link": "/contact",
      "background_image": "/assets/img/hero/home-hero.jpg",
      "status": "active",
      "order": 1,
      "created_at": "2025-11-25T12:00:00.000000Z",
      "updated_at": "2025-11-25T12:00:00.000000Z"
    }
  ]
}
```

---

### Services

#### Get All Services
Retrieve all active services ordered by display order.

**Endpoint:** `GET /services`

**Example Request:**
```bash
curl http://localhost:8000/api/v1/services
```

**Example Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "slug": "web-development",
      "title": "Web Development",
      "icon": "Code",
      "short_description": "Custom websites and web applications...",
      "full_description": "Custom websites and web applications...",
      "features": [
        "Responsive Design",
        "Fast Loading Speed",
        "Secure & Scalable",
        "SEO Optimized"
      ],
      "image": "/assets/img/services/web-development.jpg",
      "status": "active",
      "order": 1,
      "created_at": "2025-11-25T12:00:00.000000Z",
      "updated_at": "2025-11-25T12:00:00.000000Z"
    }
  ]
}
```

#### Get Single Service
Retrieve a specific service by slug.

**Endpoint:** `GET /services/{slug}`

**Example Request:**
```bash
curl http://localhost:8000/api/v1/services/web-development
```

**Example Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "slug": "web-development",
    "title": "Web Development",
    "icon": "Code",
    "short_description": "Custom websites and web applications...",
    "full_description": "Custom websites and web applications...",
    "features": ["Responsive Design", "Fast Loading Speed"],
    "image": "/assets/img/services/web-development.jpg",
    "status": "active",
    "order": 1,
    "created_at": "2025-11-25T12:00:00.000000Z",
    "updated_at": "2025-11-25T12:00:00.000000Z"
  }
}
```

---

### Blogs

#### Get All Blogs
Retrieve published blogs with pagination and filtering.

**Endpoint:** `GET /blogs`

**Query Parameters:**
- `category` (optional): Filter by category slug
- `tag` (optional): Filter by tag slug
- `search` (optional): Search in title, excerpt, and content
- `per_page` (optional): Number of items per page (default: 12)
- `page` (optional): Page number (default: 1)

**Example Request:**
```bash
curl http://localhost:8000/api/v1/blogs?category=technology&per_page=10&page=1
```

**Example Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "category_id": 1,
      "title": "Discovery incommode earnestly commanded if",
      "slug": "discovery-incommode-earnestly-commanded",
      "excerpt": "Exploring the latest technological advancements...",
      "content": "<p>Lorem ipsum dolor sit amet...</p>",
      "featured_image": "/assets/img/blog/1.jpg",
      "author_name": "John Doe",
      "author_image": null,
      "status": "published",
      "published_at": "2025-11-20T12:00:00.000000Z",
      "created_at": "2025-11-25T12:00:00.000000Z",
      "updated_at": "2025-11-25T12:00:00.000000Z",
      "category": {
        "id": 1,
        "name": "Technology",
        "slug": "technology",
        "description": "Latest technology trends and innovations"
      },
      "tags": [
        {
          "id": 1,
          "name": "Cloud",
          "slug": "cloud"
        },
        {
          "id": 2,
          "name": "Generative AI",
          "slug": "generative-ai"
        }
      ]
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 3,
    "per_page": 12,
    "total": 30
  }
}
```

#### Get Single Blog
Retrieve a specific blog post by slug.

**Endpoint:** `GET /blogs/{slug}`

**Example Request:**
```bash
curl http://localhost:8000/api/v1/blogs/discovery-incommode-earnestly-commanded
```

**Example Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "category_id": 1,
    "title": "Discovery incommode earnestly commanded if",
    "slug": "discovery-incommode-earnestly-commanded",
    "excerpt": "Exploring the latest technological advancements...",
    "content": "<p>Lorem ipsum dolor sit amet...</p>",
    "featured_image": "/assets/img/blog/1.jpg",
    "author_name": "John Doe",
    "author_image": null,
    "status": "published",
    "published_at": "2025-11-20T12:00:00.000000Z",
    "category": {
      "id": 1,
      "name": "Technology",
      "slug": "technology",
      "description": "Latest technology trends and innovations"
    },
    "tags": [
      {
        "id": 1,
        "name": "Cloud",
        "slug": "cloud"
      }
    ]
  }
}
```

#### Get Blog Categories
Retrieve all blog categories with blog count.

**Endpoint:** `GET /blog-categories`

**Example Request:**
```bash
curl http://localhost:8000/api/v1/blog-categories
```

**Example Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Technology",
      "slug": "technology",
      "description": "Latest technology trends and innovations",
      "blogs_count": 5,
      "created_at": "2025-11-25T12:00:00.000000Z",
      "updated_at": "2025-11-25T12:00:00.000000Z"
    }
  ]
}
```

#### Get Blog Tags
Retrieve all blog tags with blog count.

**Endpoint:** `GET /blog-tags`

**Example Request:**
```bash
curl http://localhost:8000/api/v1/blog-tags
```

**Example Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Cloud",
      "slug": "cloud",
      "blogs_count": 3,
      "created_at": "2025-11-25T12:00:00.000000Z",
      "updated_at": "2025-11-25T12:00:00.000000Z"
    }
  ]
}
```

---

### Settings

#### Get All Settings
Retrieve all site settings.

**Endpoint:** `GET /settings`

**Query Parameters:**
- `group` (optional): Filter by setting group (e.g., 'general', 'contact', 'social')

**Example Request:**
```bash
curl http://localhost:8000/api/v1/settings?group=general
```

**Example Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "key": "site_name",
      "value": "HC IT Solutions",
      "type": "text",
      "group": "general",
      "created_at": "2025-11-25T12:00:00.000000Z",
      "updated_at": "2025-11-25T12:00:00.000000Z"
    },
    {
      "id": 2,
      "key": "contact_email",
      "value": "info@hcitsolutions.com",
      "type": "text",
      "group": "contact",
      "created_at": "2025-11-25T12:00:00.000000Z",
      "updated_at": "2025-11-25T12:00:00.000000Z"
    }
  ]
}
```

---

## Admin Endpoints

All admin endpoints require authentication (to be implemented with Laravel Sanctum).

### Hero Sections

#### Create Hero Section
**Endpoint:** `POST /admin/hero-sections`

**Request Body:**
```json
{
  "page": "home",
  "title": "New Hero Title",
  "subtitle": "Hero Subtitle",
  "description": "Hero description text",
  "button_text": "Learn More",
  "button_link": "/about",
  "background_image": "/assets/img/hero/new-hero.jpg",
  "status": "active",
  "order": 1
}
```

**Validation Rules:**
- `page`: required, string, max:255
- `title`: required, string, max:255
- `subtitle`: nullable, string, max:255
- `description`: nullable, string
- `button_text`: nullable, string, max:255
- `button_link`: nullable, string, max:255
- `background_image`: nullable, string, max:255
- `status`: required, in:active,inactive
- `order`: nullable, integer

#### Update Hero Section
**Endpoint:** `PUT /admin/hero-sections/{id}`

**Request Body:** Same as create

#### Delete Hero Section
**Endpoint:** `DELETE /admin/hero-sections/{id}`

---

### Services

#### Create Service
**Endpoint:** `POST /admin/services`

**Request Body:**
```json
{
  "slug": "cloud-computing",
  "title": "Cloud Computing",
  "icon": "Cloud",
  "short_description": "Scalable cloud solutions...",
  "full_description": "Comprehensive cloud computing services...",
  "features": ["Scalability", "Security", "Cost-effective"],
  "image": "/assets/img/services/cloud.jpg",
  "status": "active",
  "order": 7
}
```

**Validation Rules:**
- `slug`: required, string, max:255, unique
- `title`: required, string, max:255
- `icon`: nullable, string, max:255
- `short_description`: nullable, string
- `full_description`: nullable, string
- `features`: nullable, array
- `image`: nullable, string, max:255
- `status`: required, in:active,inactive
- `order`: nullable, integer

#### Update Service
**Endpoint:** `PUT /admin/services/{id}`

**Request Body:** Same as create (slug must be unique except for current record)

#### Delete Service
**Endpoint:** `DELETE /admin/services/{id}`

---

### Blogs

#### Create Blog
**Endpoint:** `POST /admin/blogs`

**Request Body:**
```json
{
  "category_id": 1,
  "title": "New Blog Post Title",
  "slug": "new-blog-post-title",
  "excerpt": "Brief summary of the blog post...",
  "content": "<p>Full HTML content of the blog post...</p>",
  "featured_image": "/assets/img/blog/new-post.jpg",
  "author_name": "Jane Doe",
  "author_image": "/assets/img/authors/jane.jpg",
  "status": "published",
  "published_at": "2025-11-25T12:00:00",
  "tags": [1, 2, 3]
}
```

**Validation Rules:**
- `category_id`: nullable, exists:blog_categories,id
- `title`: required, string, max:255
- `slug`: required, string, max:255, unique
- `excerpt`: nullable, string
- `content`: required, string
- `featured_image`: nullable, string, max:255
- `author_name`: nullable, string, max:255
- `author_image`: nullable, string, max:255
- `status`: required, in:draft,published,archived
- `published_at`: nullable, date
- `tags`: nullable, array, exists:blog_tags,id

#### Update Blog
**Endpoint:** `PUT /admin/blogs/{id}`

**Request Body:** Same as create (slug must be unique except for current record)

#### Delete Blog
**Endpoint:** `DELETE /admin/blogs/{id}`

---

### Settings

#### Create/Update Setting
**Endpoint:** `POST /admin/settings`

**Request Body:**
```json
{
  "key": "site_name",
  "value": "HC IT Solutions",
  "type": "text",
  "group": "general"
}
```

**Validation Rules:**
- `key`: required, string, max:255
- `value`: nullable, string
- `type`: required, in:text,json,boolean
- `group`: required, string, max:255

#### Delete Setting
**Endpoint:** `DELETE /admin/settings/{id}`

---

## HTTP Status Codes

- `200 OK`: Successful GET, PUT, PATCH requests
- `201 Created`: Successful POST requests
- `204 No Content`: Successful DELETE requests
- `400 Bad Request`: Invalid request data
- `401 Unauthorized`: Missing or invalid authentication token
- `403 Forbidden`: Authenticated but not authorized
- `404 Not Found`: Resource not found
- `422 Unprocessable Entity`: Validation errors
- `500 Internal Server Error`: Server error

---

## Error Response Examples

### Validation Error (422)
```json
{
  "success": false,
  "message": "The given data was invalid.",
  "errors": {
    "title": ["The title field is required."],
    "slug": ["The slug has already been taken."]
  }
}
```

### Not Found Error (404)
```json
{
  "success": false,
  "message": "Resource not found"
}
```

### Server Error (500)
```json
{
  "success": false,
  "message": "An error occurred while processing your request."
}
```

---

## Quick Start

### Start the Laravel Server
```bash
cd hc_it_backend
php artisan serve
```

The API will be available at: `http://localhost:8000/api/v1`

### Run Migrations
```bash
php artisan migrate
```

### Seed Sample Data
```bash
php artisan db:seed
```

### Test API Endpoints
```bash
# Get all services
curl http://localhost:8000/api/v1/services

# Get home hero section
curl http://localhost:8000/api/v1/hero-sections?page=home

# Get all published blogs
curl http://localhost:8000/api/v1/blogs

# Get single blog
curl http://localhost:8000/api/v1/blogs/discovery-incommode-earnestly-commanded

# Get blog categories
curl http://localhost:8000/api/v1/blog-categories
```

---

## Notes

1. All timestamps are in UTC and follow ISO 8601 format
2. The `features` field in services is stored as JSON array
3. Blog content supports full HTML
4. Published blogs are only returned if `published_at` is in the past
5. All list endpoints support basic filtering and pagination
6. Admin endpoints will require Sanctum token in Authorization header once authentication is implemented

---

## Future Enhancements

- [ ] Implement Laravel Sanctum authentication for admin routes
- [ ] Add file upload endpoint for images
- [ ] Add bulk operations for admin endpoints
- [ ] Add sorting and advanced filtering options
- [ ] Implement rate limiting
- [ ] Add API versioning strategy
- [ ] Create Postman/Insomnia collection
- [ ] Add webhook support for content updates

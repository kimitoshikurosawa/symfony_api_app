# Nearby Product API – Symfony + React Demo

A modern, secure, and production-ready starter kit combining Symfony API Platform with React frontend, featuring clean architecture and best practices in security, testing, and containerization.

## 🚀 Features

### ✅ Backend (Symfony API Platform)

- RESTful API with API Platform
- JWT Authentication (via LexikJWTAuthenticationBundle)
- **MySQL 8.0 Database**
- Clean Code with Service Layer Pattern and DTOs
- Structured by Feature (DDD-aligned folder structure)
- API Documentation with Swagger/OpenAPI
- Search:
  - Nearby Search using geo-coordinates (Doctrine Haversine)
  - Full-text Search via MeiliSearch
- PHPUnit Testing Suite
- CORS Configuration

### ✅ Frontend (React + Leaflet)

- Modern React with TypeScript (Vite-based)
- JWT-based authentication flow
- Nearby product map with Leaflet + geolocation
- API communication via Axios
- Responsive UI (mobile-friendly)

### ✅ DevOps & Security

- Docker Compose for local setup
- Kubernetes deployment configuration (`k8s/`)
- Secure headers, rate limiting, validation
- CI/CD-ready structure

## 🛠️ Prerequisites

- Docker and Docker Compose
- Node.js 18+
- PHP 8.3+
- Composer
- kubectl (for Kubernetes)

## 🏗️ Installation

1. **Clone the repository:**
```bash
git clone https://github.com/yourusername/symfony_api_app.git
cd symfony_api_app
```

2. **Start the Docker containers:**
```bash
docker-compose up -d
```

3. **Install PHP dependencies:**
```bash
docker-compose exec app composer install
```

4. **Run migrations:**
```bash
docker-compose exec app php bin/console doctrine:migrations:migrate
```

5. **(Optional) Load fixtures:**
```bash
docker-compose exec app php bin/console doctrine:fixtures:load
```

## 🧪 Testing

Run unit and functional tests:
```bash
docker-compose exec app php bin/phpunit
```

## 🔐 Security Features

- JWT Authentication with `/auth` and token validation `/api/token/validate`
- CORS Protection via API Platform
- Input Validation (`Assert`)
- SQL Injection Prevention (Doctrine)
- XSS Protection via sanitized responses
- Secure Headers
- Structured error handling

## 🚢 Deployment

### Docker

```bash
docker-compose up -d --build
```

### Kubernetes

```bash
kubectl apply -f k8s/
```

## 📚 API Documentation

Accessible via Swagger/OpenAPI:

```
http://localhost:8000/api/docs
```

## 🗺️ Frontend Demo (Nearby Search with Map)

The frontend provides:

- User login via JWT
- Fetching all products via public API
- Nearby search (`/api/products/nearby?lat=..&lng=..`)
- Displaying products on a map using Leaflet
- Interactive map with marker popups and geolocation

📷 *Screenshots coming soon...*

## 🧱 Project Structure

```
├── src/                 # Symfony API Platform (src)
│   ├── Product/
│   │   ├── Product.php
│   │   ├── ProductManager.php
│   │   ├── ProductRepository.php
│   │   └── Controller/
│   ├── User/
│   │   ├── User.php
│   │   └── Controller/
│   ├── Shared/
│       ├── DTO/
│       ├── Enum/
│       └── Security/
├── frontend/           # React Frontend
│   ├── src/
│   ├── public/
│   └── tests/
├── docker/             # Docker Configuration
├── k8s/                # Kubernetes Configuration
└── docker-compose.yml
```

## 🤝 Contributing

1. Fork the repository  
2. Create your feature branch (`git checkout -b feature/amazing-feature`)  
3. Commit your changes (`git commit -m 'Add some amazing feature'`)  
4. Push to the branch (`git push origin feature/amazing-feature`)  
5. Open a Pull Request  

Created by [Kimana Misago](https://kimana.dev)  
GitHub: [@kimitoshikurosawa](https://github.com/kimitoshikurosawa)

## 📝 License

This project is licensed under the MIT License – see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- Symfony + API Platform  
- LexikJWTAuthenticationBundle  
- React + Leaflet  
- MeiliSearch  
- Docker & Kubernetes

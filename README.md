# Symfony API Platform + React Starter

A modern, secure, and production-ready starter kit combining Symfony API Platform with React frontend, featuring best practices in security, testing, and containerization.

## 🚀 Features

- **Backend (Symfony API Platform)**
  - RESTful API with API Platform
  - JWT Authentication
  - PostgreSQL Database
  - PHPUnit Testing Suite
  - API Documentation with Swagger/OpenAPI
  - CORS Configuration
  - MeiliSearch Integration

- **Frontend (React)**
  - Modern React with TypeScript
  - API Integration
  - Secure Authentication Flow
  - Responsive Design

- **DevOps & Security**
  - Docker Containerization
  - Kubernetes Deployment Configs
  - Security Best Practices
  - CI/CD Ready

## 🛠️ Prerequisites

- Docker and Docker Compose
- Node.js 18+ (for local development)
- PHP 8.3+
- Composer
- kubectl (for Kubernetes deployment)

## 🏗️ Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/symfony_api_app.git
cd symfony_api_app
```

2. Start the Docker containers:
```bash
docker-compose up -d
```

3. Install PHP dependencies:
```bash
docker-compose exec app composer install
```

4. Set up the database:
```bash
docker-compose exec app php bin/console doctrine:migrations:migrate
```

5. Load fixtures (optional):
```bash
docker-compose exec app php bin/console doctrine:fixtures:load
```

## 🧪 Testing

Run PHPUnit tests:
```bash
docker-compose exec app php bin/phpunit
```

## 🔐 Security Features

- JWT Authentication
- CORS Protection
- Input Validation
- SQL Injection Prevention
- XSS Protection
- Rate Limiting
- Secure Headers

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

Access the API documentation at:
```
http://localhost:8000/api/docs
```

## 🏗️ Project Structure

```
├── api/                 # Symfony API Platform
│   ├── src/
│   │   ├── Controller/
│   │   ├── Entity/
│   │   ├── Repository/
│   │   └── Tests/
├── frontend/           # React Frontend
│   ├── src/
│   ├── public/
│   └── tests/
├── docker/            # Docker Configuration
├── k8s/              # Kubernetes Configuration
└── docker-compose.yml
```

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- Symfony API Platform
- React
- Docker
- Kubernetes
- MeiliSearch

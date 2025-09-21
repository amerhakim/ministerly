# Classera EMS Docker Deployment Guide

## 🚀 Deployment Status

Your Classera EMS system has been successfully deployed to Docker Desktop with the following services:

### ✅ Running Services

| Service | Container Name | Port | Status | Description |
|---------|----------------|------|--------|-------------|
| **MySQL Database** | `classera-ems-mysql` | 3306 | ✅ Running | Main database for Classera EMS |
| **phpMyAdmin** | `classera-ems-phpmyadmin` | 8081 | ✅ Running | Database management interface |
| **Redis Cache** | `classera-ems-redis` | 6379 | ✅ Running | Caching and session storage |

### 🔧 Configuration

- **Database Name**: `classera_ems`
- **Database User**: `classera_user`
- **Database Password**: `classera_pass_2024`
- **Root Password**: `classera_root_2024`

## 🌐 Access Points

### Database Management
- **phpMyAdmin**: http://localhost:8081
  - Username: `classera_user`
  - Password: `classera_pass_2024`

### Database Direct Access
- **MySQL**: `localhost:3306`
  - Username: `classera_user`
  - Password: `classera_pass_2024`
  - Database: `classera_ems`

### Cache Service
- **Redis**: `localhost:6379`
  - No authentication required (development setup)

## 📋 Next Steps

### 1. Database Setup
The database has been initialized with:
- ✅ Default admin user (username: `admin`, password: `admin123`)
- ✅ Basic system configuration
- ✅ Default academic periods, institution types, and statuses
- ✅ Classera EMS branding and labels

### 2. Application Deployment
To complete the deployment, you need to:

1. **Build the application container**:
   ```bash
   docker-compose build app
   ```

2. **Start the application**:
   ```bash
   docker-compose up -d app
   ```

3. **Start the web server**:
   ```bash
   docker-compose up -d nginx
   ```

### 3. Access the Application
Once the application is running:
- **Main Application**: http://localhost
- **Admin Login**: 
  - Username: `admin`
  - Password: `admin123`

## 🛠️ Management Commands

### View All Services
```bash
docker-compose ps
```

### View Logs
```bash
# All services
docker-compose logs

# Specific service
docker-compose logs mysql
docker-compose logs app
```

### Stop Services
```bash
# Stop all services
docker-compose down

# Stop specific service
docker-compose stop mysql
```

### Restart Services
```bash
# Restart all services
docker-compose restart

# Restart specific service
docker-compose restart mysql
```

### Update Services
```bash
# Pull latest images and restart
docker-compose pull
docker-compose up -d
```

## 🔒 Security Notes

### Production Deployment
For production deployment, please:

1. **Change default passwords** in `.env` file
2. **Enable SSL/HTTPS** by configuring SSL certificates
3. **Set up proper firewall rules**
4. **Configure backup strategies**
5. **Set up monitoring and logging**

### Environment Variables
Review and update the `.env` file with:
- Strong database passwords
- Application secrets
- Email configuration
- SSL certificates (if using HTTPS)

## 📁 File Structure

```
ministerly/
├── docker/
│   ├── apache/          # Apache configuration
│   ├── nginx/           # Nginx configuration
│   ├── mysql/           # Database initialization
│   └── php/             # PHP configuration
├── docker-compose.yml   # Docker services definition
├── Dockerfile          # Application container definition
├── .env                # Environment variables
└── DOCKER_DEPLOYMENT.md # This guide
```

## 🆘 Troubleshooting

### Common Issues

1. **Port conflicts**: Ensure ports 3306, 6379, 8081, and 80 are not in use
2. **Permission issues**: Run Docker Desktop as administrator
3. **Memory issues**: Ensure Docker Desktop has sufficient memory allocated

### Getting Help

- Check container logs: `docker-compose logs [service-name]`
- Verify container status: `docker-compose ps`
- Restart problematic services: `docker-compose restart [service-name]`

## 🎉 Success!

Your Classera EMS infrastructure is now running on Docker Desktop! The database and supporting services are ready for the application deployment.

---

**Classera EMS** - Education Management System  
Copyright © 2024 Classera. All rights reserved.  
For support: support@classera.com

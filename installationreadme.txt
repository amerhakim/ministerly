Classera EMS - Installation Guide
=====================================

Docker Deployment Configuration
===============================

This document provides the complete configuration details for deploying Classera EMS using Docker containers.

Prerequisites
=============
- Docker Desktop installed and running
- Git (to clone the repository)
- PowerShell (for Windows deployment scripts)

Quick Start
===========
1. Clone the repository
2. Navigate to the project directory
3. Run: .\deploy.ps1
4. Access the application at: http://localhost

Container Configuration
=======================

Database Connection Settings
----------------------------
When running the installer, use these exact settings:

Database Connection Information:
- Database Server Host: mysql
- Database Server Port: 3306
- Admin User: root
- Admin Password: classera_root_2024

IMPORTANT: Use 'mysql' as the hostname, NOT 'localhost'
This is because Docker containers communicate using internal hostnames.

The installer will automatically create:
- Database: classera_ems
- Database User: classera_user
- Database Password: [Your chosen password from the form]

Administrator Account
---------------------
- Account Username: admin (pre-filled, disabled)
- Account Password: [Your chosen password]
- Retype Password: [Same password]

Country / Area Information
--------------------------
- Country Code: [Your country code, e.g., US, GB, AE]
- Country Name: [Your country name, e.g., United States, United Kingdom, United Arab Emirates]

Docker Services
===============

Container Details:
-----------------
- classera-ems-app: PHP 7.4 + Apache application server (Port: 8082)
- classera-ems-nginx: Nginx reverse proxy (Port: 80, 443)
- classera-ems-mysql: MySQL 8.0 database server (Port: 3306)
- classera-ems-redis: Redis cache server (Port: 6379)
- classera-ems-phpmyadmin: Database administration tool (Port: 8081)

Network Configuration:
--------------------
All containers run on the 'classera-network' bridge network for internal communication.

Environment Variables
=====================
The following environment variables are configured in .env:

MYSQL_ROOT_PASSWORD=classera_root_2024
MYSQL_DATABASE=classera_ems
MYSQL_USER=classera_user
MYSQL_PASSWORD=classera_pass_2024

Access Points
=============
- Main Application: http://localhost
- phpMyAdmin: http://localhost:8081
- Direct App Access: http://localhost:8082

Troubleshooting
===============

Common Issues:
-------------

1. "SQLSTATE[HY000] [2002] No such file or directory"
   - Solution: Use 'mysql' as database host, not 'localhost'

2. "localhost refused to connect"
   - Solution: Ensure all containers are running: docker-compose ps

3. "502 Bad Gateway"
   - Solution: Check if app container is healthy: docker logs classera-ems-app

4. Form fields not showing in installer
   - Solution: This has been fixed in the latest version

5. "localhost redirected you too many times" after database configuration
   - Solution: This has been fixed by setting installerCore to false in config/app.php
   - The installer now uses correct Classera database settings instead of old OpenEMIS values

Container Management Commands:
-----------------------------
- Start all services: docker-compose up -d
- Stop all services: docker-compose down
- View logs: docker-compose logs [service-name]
- Restart app: docker-compose restart app
- Rebuild app: docker-compose build app

File Structure
==============
```
├── Dockerfile                 # PHP 7.4 + Apache container
├── docker-compose.yml        # Multi-container orchestration
├── .env                      # Environment variables
├── docker/                   # Docker configuration files
│   ├── apache/              # Apache virtual host config
│   ├── nginx/               # Nginx configuration
│   ├── php/                 # PHP configuration
│   └── mysql/               # MySQL initialization
└── deploy.ps1               # Windows deployment script
```

Security Notes
==============
- Default passwords are provided for development
- Change all passwords in production
- Database credentials are stored in .env file
- SSL/TLS configuration available in docker/nginx/ssl/

License Information
==================
Classera License: Copyright © 2024 Classera. All rights reserved.

This software and all related materials are the exclusive property of Classera.
All intellectual property rights, including copyrights, patents, and trademarks,
are owned by Classera and are protected by applicable laws and international treaties.

Support
=======
For technical support, contact: support@classera.com

Version Information
==================
- Classera EMS: 1.0.0
- PHP: 7.4
- MySQL: 8.0
- Nginx: Alpine
- Redis: 7-alpine

Last Updated: September 2025

# Classera EMS Docker Deployment Script
# PowerShell script for Windows

Write-Host "🚀 Starting Classera EMS Docker Deployment..." -ForegroundColor Green

# Check if Docker is running
Write-Host "📋 Checking Docker status..." -ForegroundColor Yellow
try {
    docker version | Out-Null
    Write-Host "✅ Docker is running" -ForegroundColor Green
} catch {
    Write-Host "❌ Docker is not running. Please start Docker Desktop first." -ForegroundColor Red
    exit 1
}

# Create .env file if it doesn't exist
if (!(Test-Path ".env")) {
    Write-Host "📝 Creating .env file..." -ForegroundColor Yellow
    Copy-Item ".env.example" ".env"
    Write-Host "✅ .env file created. Please review and modify the configuration." -ForegroundColor Green
}

# Stop existing containers
Write-Host "🛑 Stopping existing containers..." -ForegroundColor Yellow
docker-compose down

# Build and start containers
Write-Host "🔨 Building and starting containers..." -ForegroundColor Yellow
docker-compose up -d --build

# Wait for services to be ready
Write-Host "⏳ Waiting for services to be ready..." -ForegroundColor Yellow
Start-Sleep -Seconds 30

# Check container status
Write-Host "📊 Checking container status..." -ForegroundColor Yellow
docker-compose ps

Write-Host "🎉 Deployment completed!" -ForegroundColor Green
Write-Host "🌐 Access your application at: http://localhost" -ForegroundColor Cyan
Write-Host "🗄️  phpMyAdmin at: http://localhost:8081" -ForegroundColor Cyan
Write-Host "📧 Default admin credentials: admin / admin123" -ForegroundColor Yellow

@echo off
REM ------------------------------------------------------------
REM  start-stack.bat  —  Spins up the whole micro-services stack
REM ------------------------------------------------------------

REM  Run `docker compose` with all compose files.
REM  The caret (^) lets us split one long command across lines.

REM Ensure shell scripts use LF line endings
  
docker compose ^
  -f docker-compose.yml ^
  -f sql-server/docker-compose.yml ^
  -f docker-compose.mgmt.yml ^
  -f kong-gateway/docker-compose.yml ^
  -f analytics-service/docker-compose.yml ^
  -f keycloak-auth-service/docker-compose.yml ^
  -f catalog-service/docker-compose.yml ^
  -f notification-service/docker-compose.yml ^
  -f order-service/docker-compose.yml ^
  -f payment-service/docker-compose.yml ^
  -f user-service/docker-compose.yml ^
  up -d

REM  Propagate Docker’s exit code and keep the window open
IF %ERRORLEVEL% NEQ 0 (
    echo.
    echo Docker Compose failed with exit code %ERRORLEVEL%.
    pause
    exit /b %ERRORLEVEL%
)

echo.
echo Stack started successfully.
pause

BEGIN TRY
  BEGIN TRANSACTION;
	--------------------------------------------------------------------------------
	-- 1) analytics-service
	--------------------------------------------------------------------------------
		USE analytics_service_db;

		ALTER ROLE db_datawriter ADD MEMBER analytics_service_user;

		ALTER USER analytics_service_user WITH DEFAULT_SCHEMA = dbo;
		GRANT CREATE TABLE TO analytics_service_user; 
		GRANT ALTER ON SCHEMA::dbo TO analytics_service_user; 
		GRANT REFERENCES ON SCHEMA::dbo TO analytics_service_user; 
		GRANT VIEW DEFINITION ON SCHEMA::dbo TO analytics_service_user;
		GRANT CONTROL ON SCHEMA::dbo TO analytics_service_user; 

		GRANT EXECUTE TO analytics_service_user;

	--------------------------------------------------------------------------------
	-- 2) api-gateway
	--------------------------------------------------------------------------------

		USE api_gateway_db;

		ALTER ROLE db_datawriter ADD MEMBER api_gateway_user;

		ALTER USER api_gateway_user WITH DEFAULT_SCHEMA = dbo;
		GRANT CREATE TABLE TO api_gateway_user; 
		GRANT ALTER ON SCHEMA::dbo TO api_gateway_user; 
		GRANT REFERENCES ON SCHEMA::dbo TO api_gateway_user; 
		GRANT VIEW DEFINITION ON SCHEMA::dbo TO api_gateway_user;
		GRANT CONTROL ON SCHEMA::dbo TO api_gateway_user;

		GRANT EXECUTE TO api_gateway_user;

	--------------------------------------------------------------------------------
	-- 3) laravel-gateway
	--------------------------------------------------------------------------------

		USE laravel_gateway_db;

		ALTER ROLE db_datawriter ADD MEMBER laravel_gateway_user;

		ALTER USER laravel_gateway_user WITH DEFAULT_SCHEMA = dbo;
		GRANT CREATE TABLE TO laravel_gateway_user; 
		GRANT ALTER ON SCHEMA::dbo TO laravel_gateway_user; 
		GRANT REFERENCES ON SCHEMA::dbo TO laravel_gateway_user; 
		GRANT VIEW DEFINITION ON SCHEMA::dbo TO laravel_gateway_user;
		GRANT CONTROL ON SCHEMA::dbo TO laravel_gateway_user;

		GRANT EXECUTE TO laravel_gateway_user;

	--------------------------------------------------------------------------------
	-- 4) kong-gateway
	--------------------------------------------------------------------------------

		USE kong_gateway_db;

		ALTER ROLE db_datawriter ADD MEMBER kong_gateway_user;

		ALTER USER kong_gateway_user WITH DEFAULT_SCHEMA = dbo;
		GRANT CREATE TABLE TO kong_gateway_user; 
		GRANT ALTER ON SCHEMA::dbo TO kong_gateway_user; 
		GRANT REFERENCES ON SCHEMA::dbo TO kong_gateway_user; 
		GRANT VIEW DEFINITION ON SCHEMA::dbo TO kong_gateway_user;
		GRANT CONTROL ON SCHEMA::dbo TO kong_gateway_user;

		GRANT EXECUTE TO kong_gateway_user;

	--------------------------------------------------------------------------------
	-- 5) jwt-service
	--------------------------------------------------------------------------------

		USE jwt_service_db;

		ALTER ROLE db_datawriter ADD MEMBER jwt_service_user;

		ALTER USER jwt_service_user WITH DEFAULT_SCHEMA = dbo;
		GRANT CREATE TABLE TO jwt_service_user; 
		GRANT ALTER ON SCHEMA::dbo TO jwt_service_user; 
		GRANT REFERENCES ON SCHEMA::dbo TO jwt_service_user; 
		GRANT VIEW DEFINITION ON SCHEMA::dbo TO jwt_service_user;
		GRANT CONTROL ON SCHEMA::dbo TO jwt_service_user;

		GRANT EXECUTE TO jwt_service_user;

	--------------------------------------------------------------------------------
	-- 6) catalog-service
	--------------------------------------------------------------------------------

		USE catalog_service_db;

		ALTER ROLE db_datawriter ADD MEMBER catalog_service_user;

		ALTER USER catalog_service_user WITH DEFAULT_SCHEMA = dbo;
		GRANT CREATE TABLE TO catalog_service_user; 
		GRANT ALTER ON SCHEMA::dbo TO catalog_service_user; 
		GRANT REFERENCES ON SCHEMA::dbo TO catalog_service_user; 
		GRANT VIEW DEFINITION ON SCHEMA::dbo TO catalog_service_user;
		GRANT CONTROL ON SCHEMA::dbo TO catalog_service_user;

		GRANT EXECUTE TO catalog_service_user;

	--------------------------------------------------------------------------------
	-- 7) frontend
	--------------------------------------------------------------------------------

		USE frontend_db;

		ALTER ROLE db_datawriter ADD MEMBER frontend_user;

		ALTER USER frontend_user WITH DEFAULT_SCHEMA = dbo;
		GRANT CREATE TABLE TO frontend_user; 
		GRANT ALTER ON SCHEMA::dbo TO frontend_user; 
		GRANT REFERENCES ON SCHEMA::dbo TO frontend_user; 
		GRANT VIEW DEFINITION ON SCHEMA::dbo TO frontend_user;
		GRANT CONTROL ON SCHEMA::dbo TO frontend_user;

		GRANT EXECUTE TO frontend_user;

	--------------------------------------------------------------------------------
	-- 8) notification-service
	--------------------------------------------------------------------------------

		USE notification_service_db;

		ALTER ROLE db_datawriter ADD MEMBER notification_service_user;

		ALTER USER notification_service_user WITH DEFAULT_SCHEMA = dbo;
		GRANT CREATE TABLE TO notification_service_user; 
		GRANT ALTER ON SCHEMA::dbo TO notification_service_user; 
		GRANT REFERENCES ON SCHEMA::dbo TO notification_service_user; 
		GRANT VIEW DEFINITION ON SCHEMA::dbo TO notification_service_user;
		GRANT CONTROL ON SCHEMA::dbo TO notification_service_user;

		GRANT EXECUTE TO notification_service_user;

	--------------------------------------------------------------------------------
	-- 9) order-service
	--------------------------------------------------------------------------------

		USE order_service_db;

		ALTER ROLE db_datawriter ADD MEMBER order_service_user;

		ALTER USER order_service_user WITH DEFAULT_SCHEMA = dbo;
		GRANT CREATE TABLE TO order_service_user; 
		GRANT ALTER ON SCHEMA::dbo TO order_service_user; 
		GRANT REFERENCES ON SCHEMA::dbo TO order_service_user; 
		GRANT VIEW DEFINITION ON SCHEMA::dbo TO order_service_user;
		GRANT CONTROL ON SCHEMA::dbo TO order_service_user;

		GRANT EXECUTE TO order_service_user;

	--------------------------------------------------------------------------------
	-- 10) payment-service
	--------------------------------------------------------------------------------

		USE payment_service_db;

		ALTER ROLE db_datawriter ADD MEMBER payment_service_user;

		ALTER USER payment_service_user WITH DEFAULT_SCHEMA = dbo;
		GRANT CREATE TABLE TO payment_service_user; 
		GRANT ALTER ON SCHEMA::dbo TO payment_service_user; 
		GRANT REFERENCES ON SCHEMA::dbo TO payment_service_user; 
		GRANT VIEW DEFINITION ON SCHEMA::dbo TO payment_service_user;
		GRANT CONTROL ON SCHEMA::dbo TO payment_service_user;

		GRANT EXECUTE TO payment_service_user;

	--------------------------------------------------------------------------------
	-- 11) user-service
	--------------------------------------------------------------------------------

		USE user_service_db;

		ALTER ROLE db_datawriter ADD MEMBER user_service_user;

		ALTER USER user_service_user WITH DEFAULT_SCHEMA = dbo;
		GRANT CREATE TABLE TO user_service_user; 
		GRANT ALTER ON SCHEMA::dbo TO user_service_user; 
		GRANT REFERENCES ON SCHEMA::dbo TO user_service_user; 
		GRANT VIEW DEFINITION ON SCHEMA::dbo TO user_service_user;
		GRANT CONTROL ON SCHEMA::dbo TO user_service_user;

		GRANT EXECUTE TO user_service_user;

	--------------------------------------------------------------------------------
	-- 12) auth-service
	--------------------------------------------------------------------------------

		USE auth_service_db;

		ALTER ROLE db_datawriter ADD MEMBER auth_service_user;

		ALTER USER auth_service_user WITH DEFAULT_SCHEMA = dbo;
		GRANT CREATE TABLE TO auth_service_user; 
		GRANT ALTER ON SCHEMA::dbo TO auth_service_user; 
		GRANT REFERENCES ON SCHEMA::dbo TO auth_service_user; 
		GRANT VIEW DEFINITION ON SCHEMA::dbo TO auth_service_user;
		GRANT CONTROL ON SCHEMA::dbo TO auth_service_user;

		GRANT EXECUTE TO auth_service_user;

		
    COMMIT TRANSACTION;
  END TRY
BEGIN CATCH
	IF @@TRANCOUNT > 0
		ROLLBACK TRANSACTION;

	-- Rilascia l’errore originario
	DECLARE @ErrMsg NVARCHAR(4000) = ERROR_MESSAGE();
	DECLARE @ErrSev INT = ERROR_SEVERITY();
	RAISERROR (@ErrMsg, @ErrSev, 1);
END CATCH;
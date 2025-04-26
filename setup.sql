BEGIN TRY
  BEGIN TRANSACTION;
	--------------------------------------------------------------------------------
	-- 1) analytics-service
	--------------------------------------------------------------------------------
		-- Creazione del database
		CREATE DATABASE analytics_service_db;

		-- Creazione del login a livello di istanza
		CREATE LOGIN analytics_service_user 
		WITH PASSWORD = 'analytics_service_password',
		  -- disabilita sia la policy di complessità sia lo scadere della password
		  CHECK_POLICY = OFF,
		  CHECK_EXPIRATION = OFF;

		-- Passaggio al contesto del nuovo database
		USE analytics_service_db;

		-- Creazione dell’utente all’interno del database
		CREATE USER analytics_service_user 
		FOR LOGIN analytics_service_user;

		-- Concessione dei ruoli di lettura e scrittura
		ALTER ROLE db_datareader ADD MEMBER analytics_service_user;

		ALTER ROLE db_datawriter ADD MEMBER analytics_service_user;

		-- Concessione del permesso di EXECUTE su tutte le stored procedure
		GRANT EXECUTE TO analytics_service_user;

	--------------------------------------------------------------------------------
	-- 2) api-gateway
	--------------------------------------------------------------------------------
		CREATE DATABASE api_gateway_db;

		CREATE LOGIN api_gateway_user 
		WITH PASSWORD = 'api_gateway_password',
		  CHECK_POLICY = OFF,
		  CHECK_EXPIRATION = OFF;

		USE api_gateway_db;

		CREATE USER api_gateway_user 
		FOR LOGIN api_gateway_user;

		ALTER ROLE db_datareader ADD MEMBER api_gateway_user;

		ALTER ROLE db_datawriter ADD MEMBER api_gateway_user;

		GRANT EXECUTE TO api_gateway_user;

	--------------------------------------------------------------------------------
	-- 3) auth-service
	--------------------------------------------------------------------------------
		CREATE DATABASE auth_service_db;

		CREATE LOGIN auth_service_user 
		WITH PASSWORD = 'auth_service_password',
		  CHECK_POLICY = OFF,
		  CHECK_EXPIRATION = OFF;

		USE auth_service_db;

		CREATE USER auth_service_user 
		FOR LOGIN auth_service_user;

		ALTER ROLE db_datareader ADD MEMBER auth_service_user;

		ALTER ROLE db_datawriter ADD MEMBER auth_service_user;

		GRANT EXECUTE TO auth_service_user;

	--------------------------------------------------------------------------------
	-- 4) catalog-service
	--------------------------------------------------------------------------------
		CREATE DATABASE catalog_service_db;

		CREATE LOGIN catalog_service_user 
		WITH PASSWORD = 'catalog_service_password',
		  CHECK_POLICY = OFF,
		  CHECK_EXPIRATION = OFF;

		USE catalog_service_db;

		CREATE USER catalog_service_user 
		FOR LOGIN catalog_service_user;

		ALTER ROLE db_datareader ADD MEMBER catalog_service_user;

		ALTER ROLE db_datawriter ADD MEMBER catalog_service_user;

		GRANT EXECUTE TO catalog_service_user;

	--------------------------------------------------------------------------------
	-- 5) frontend
	--------------------------------------------------------------------------------
		CREATE DATABASE frontend_db;

		CREATE LOGIN frontend_user 
		WITH PASSWORD = 'frontend_password',
		  CHECK_POLICY = OFF,
		  CHECK_EXPIRATION = OFF;

		USE frontend_db;

		CREATE USER frontend_user 
		FOR LOGIN frontend_user;

		ALTER ROLE db_datareader ADD MEMBER frontend_user;

		ALTER ROLE db_datawriter ADD MEMBER frontend_user;

		GRANT EXECUTE TO frontend_user;

	--------------------------------------------------------------------------------
	-- 6) notification-service
	--------------------------------------------------------------------------------
		CREATE DATABASE notification_service_db;

		CREATE LOGIN notification_service_user 
		WITH PASSWORD = 'notification_service_password',
		  CHECK_POLICY = OFF,
		  CHECK_EXPIRATION = OFF;

		USE notification_service_db;

		CREATE USER notification_service_user 
		FOR LOGIN notification_service_user;

		ALTER ROLE db_datareader ADD MEMBER notification_service_user;

		ALTER ROLE db_datawriter ADD MEMBER notification_service_user;

		GRANT EXECUTE TO notification_service_user;

	--------------------------------------------------------------------------------
	-- 7) order-service
	--------------------------------------------------------------------------------
		CREATE DATABASE order_service_db;

		CREATE LOGIN order_service_user 
		WITH PASSWORD = 'order_service_password',
		  CHECK_POLICY = OFF,
		  CHECK_EXPIRATION = OFF;

		USE order_service_db;

		CREATE USER order_service_user 
		FOR LOGIN order_service_user;

		ALTER ROLE db_datareader ADD MEMBER order_service_user;

		ALTER ROLE db_datawriter ADD MEMBER order_service_user;

		GRANT EXECUTE TO order_service_user;

	--------------------------------------------------------------------------------
	-- 8) payment-service
	--------------------------------------------------------------------------------
		CREATE DATABASE payment_service_db;

		CREATE LOGIN payment_service_user 
		WITH PASSWORD = 'payment_service_password',
		  CHECK_POLICY = OFF,
		  CHECK_EXPIRATION = OFF;

		USE payment_service_db;

		CREATE USER payment_service_user 
		FOR LOGIN payment_service_user;

		ALTER ROLE db_datareader ADD MEMBER payment_service_user;

		ALTER ROLE db_datawriter ADD MEMBER payment_service_user;

		GRANT EXECUTE TO payment_service_user;

	--------------------------------------------------------------------------------
	-- 9) user-service
	--------------------------------------------------------------------------------
		CREATE DATABASE user_service_db;

		CREATE LOGIN user_service_user 
		WITH PASSWORD = 'user_service_password',
		  CHECK_POLICY = OFF,
		  CHECK_EXPIRATION = OFF;

		USE user_service_db;

		CREATE USER user_service_user 
		FOR LOGIN user_service_user;

		ALTER ROLE db_datareader ADD MEMBER user_service_user;

		ALTER ROLE db_datawriter ADD MEMBER user_service_user;

		GRANT EXECUTE TO user_service_user;

		
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
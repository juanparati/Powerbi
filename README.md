# PHP PowerBI Interface

## 1. What is it?

A PHP Library for the [PowerBI Rest API](https://docs.microsoft.com/en-gb/rest/api/power-bi/).


## 2. Which services are implemented?

| Service | Class                                |
|---------|--------------------------------------|
| Dataset | \Juanparati\PowerBI\Services\Dataset |
| Group   | \Juanparati\PowerBI\Services\Group   |

Please feel free to contribute with additional services.


## 3. How it works?


## 3.1 Create a dataset into the default workspace/group

        // Instatiate the client passing the auth token.     
        $client = new \Juanparati\PowerBI\Client($token);
        
        // Create a dataset
        $dataset_model              = new \Juanparati\PowerBI\Models\DatasetModel();
        $dataset_model->name        = 'My Dataset';
        $dataset_model->defaultMode = \Juanparati\PowerBI\Enums\DatasetModeEnum::PUSH;
        
        // Add table to dataset
        $table = new \Juanparati\PowerBI\Models\TableModel();
        $table->name = 'My Table';
        
        // Add columns to table
        $columns = [
            new \Juanparati\PowerBI\Models\ColumnModel(
            [
                'name'     => 'first_column',
                'dataType' => \Juanparati\PowerBI\Enums\DatatypesEnum::STRING
            ]),
            new \Juanparati\PowerBI\Models\ColumnModel(
            [
                'name'     => 'second_column',
                'dataType' => \Juanparati\PowerBI\Enums\DatatypesEnum::Int64
            ]),            
        );
               
        $table->columns = $columns;
        
        // Attach tables to dataset model
        $dataset->tables = [$table];
        
        // Create dataset.
        // 
        // Note: Use postDatasetInGroup method in case that dataset should be created in a different
        // workspace/group. 
        $result = (new \Juanparati\PowerBI\Services\Dataset($client))->postDataset($dataset);
        
               
        // Check if dataset was sucessfully created
        if ($result->isOk()) {
            echo "Dataset created: ";
            
            // Display dataset Id
            echo $result->response()->id;
        }
        

## 3.2 Create a workspace/group 

         // Instatiate the client passing the auth token.     
         $client = new \Juanparati\PowerBI\Client($token);
                          
         $result = (new \Juanparati\PowerBI\Services\Group($client))->postGroup('My new workspace');
         
         if ($result->isOk()) {
             echo "Group created: ";
                     
             // Display dataset Id
             echo $result->response()->id;
         }
         
         
## 3.3 Add rows to dataset


        // Add rows/records
        $rows = 
        [
            [
                'first_column'  => 'foo',
                'second_column' => 1
            ],
            [
                'first_column'  => 'bar',
                'second_column' => 2
            ]
        ];
         
         
        // Post rows/records.
        // 
        // Note: Use postRowsByDatasetIdInGroup method in case that dataset is assigned to the 
        // non-default dataset.
        $result = (new Dataset(static::$client))->postRowsByDatasetId($rows, 'My Table', $dataset_id);
         
        // Obtain the results as an associative array.
        var_dump($result->response(true));

         

## 4. How to obtain the authentication token (Non-interactive authentication)

There different ways to obtain the authentication token but this way is most used:

1. Register an [Azure Active Directory App](https://dev.powerbi.com/apps/) with all the required permissions
2. Copy somewhere the "Application Id" and "Client secret"
3. [Grant admin consent to the created application](https://docs.microsoft.com/en-us/azure/active-directory/manage-apps/configure-user-consent#grant-admin-consent-when-registering-an-app-in-the-azure-portal) (Required for non-interactive authentication)
4. Find the tenand ID (Directory ID) and copy it to somewhere (Azure Console -> Dashboard -> Azure Active Directory -> Properties -> Directory ID)
5. Execute the following code (Note: [league/oauth2-server](https://github.com/thephpleague/oauth2-server) library is required):

		
		$application_id     = '<The application id>';
		$application_secret = '<The application secret>';
		
		$directory_id       = '<The azure tenant id>';
		
		$user               = '<Admin e-mail or username used in the app registration process>';
		$password           = '<Admin password used in the app registration process>';
		
		$token_file         = 'token.txt';

		// Authenticate
		$provider = new \League\OAuth2\Client\Provider\GenericProvider([
			'clientId'                => $application_id,
			'clientSecret'            => $application_secret,
			'urlAuthorize'            => "https://login.microsoftonline.com/common/oauth2/v2.0/authorize",
			'urlAccessToken'          => "https://login.windows.net/$directory_id/oauth2/token",
			'urlResourceOwnerDetails' => '',
			'scopes'                  => 'openid',
		]);

		try {
			// Try to get an access token using the resource owner password credentials grant.
			$accessToken = $provider->getAccessToken('password', [
				'username' => $user,
				'password' => $password,
				'resource' => 'https://analysis.windows.net/powerbi/api'
			]);

			$token = $accessToken->getToken();

		} catch (\Exception $e) {
		    
			echo 'Unable to retrieve token' . PHP_EOL;
			
			die($e->getMessage());		
		}

		// Save token
		file_put_contents($token_file, $token);

        echo '🔑 Token saved in ' . $token_file);
        


## 5. PowerBI API Restrictions

This library doesn't take care about the [PowerBI API Restrictions](https://docs.microsoft.com/en-us/power-bi/developer/api-rest-api-limitations).


## 6. Unit tests

Unit tests are not mocked, so it means that request are done against the real PowerBI API. Never execute the unit tests against a production account.

In order to execute the tests the auth token should be added to the environment variable "POWERBI_AUTH_TOKEN":

        export POWERBI_AUTH_TOKEN=<Your token>

<?php

namespace Juanparati\PowerBI\Enums;


/**
 * Class DatasetMode.
 *
 * @package Juanparati\Enums\DatasetMode
 */
class DatasetModeEnum
{

	/**
	 * DatasetModes.
	 *
	 * @see https://docs.microsoft.com/en-gb/rest/api/power-bi/pushdatasets/datasets_postdataset#datasetmode
	 */

	// Creates a dataset with a live connection to Azure Analysis Service.
	const AS_AZURE 	 	 = 'AsAzure'	  ;

	// Creates a dataset with a live connection to On-premise Analysis Service.
	const AS_ON_PREM 	 = 'AsOnPrem'	  ;

	// Creates a dataset which allows programmatic access for pushing data into PowerBI.
	const PUSH 		 	 = 'Push'		  ;

	// Creates a dataset which supports data streaming and allows programmatic access for pushing data into Power BI.
	const PUSH_STREAMING = 'PushStreaming';

	// Creates a dataset which supports data streaming.
	const STREAMING 	 = 'Streaming'	  ;

}

<?php


namespace Juanparati\PowerBI\Enums;


/**
 * Class CrossFilteringBehaviorEnum.
 *
 *
 * @package Juanparati\PowerBI\Enums
 */
class CrossFilteringBehaviorEnum
{

	/**
	 * Cross filtering behaviour
	 *
	 * @see https://docs.microsoft.com/en-us/dotnet/api/microsoft.powerbi.api.v2.models.crossfilteringbehaviorenum?view=azure-dotnet
	 */
	const ONE_DIRECTION 	= 'OneDirection'  ;
	const BOTH_DIRECTIONS 	= 'BothDirections';
	const AUTOMATIC 		= 'Automatic'	  ;

}

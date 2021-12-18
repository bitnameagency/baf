<?php
	/** 
	 * bitnameagency.php
	 *
	 * Bitname Agency Framework
	 *
	 * @package    bitnameagency
	 * @author     Kazim İNEM
	 * @copyright  2021 BitnameAgency
	 * @license    http://license.bitnameagency.com Bitname Agency Lisans Sistemi
	 * @version    CVS: 5.4.2
	 * @link       https://bitnameagency.com
	 * DİKKAT: Bu framework "Bitname Agency™" tarafından lisans ile dağıtılmaktadır.
	 * DİKKAT: Mevcut sunucu & domain dışında kullanılması, kopyalanması kesinlikle yasaktır.
	 * DİKKAT: Tesbiti halinde yasal mercilere bildirim sağlanacaktır.
	 * DİKKAT: Bitname Agency lisans iptal etme hakkını saklı tutar.
	 */

	if (!defined('ABSPATH'))
	{
		exit; // Exit if accessed directly.
		
	}

	    ob_start();
		require_once ("bitnameagencyframework/bitnameagency.php");

	try
	{
		


	  

		$indexData = hookSystem::do_action("index");
		echo $indexData;
		$GlobalindexData = ob_get_contents();

		ob_end_clean();
		ob_start();
		if (renderBlock == true and immunity() !== true)
		{

			if ($indexData !== $GlobalindexData)
			{

				throw new Exception("Bitname Agency Framework blocks directly rendered objects. <br> Please use view."); //ERROR
				//echo $indexData;
				
			}
			else
			{

				echo $indexData;

			}

		}
		else
		{

			echo $GlobalindexData;

		}

	
		
		
	}
	catch(Exception $e)
	{

		echo catchError::go($e->getMessage() , errorMail);
		die();

	}

	echo hookSystem::do_action("modalError");



	/*************************************/

	$FormTokenSecure = new FormTokenSecure();
	$captcha = new captcha;
	$latestOutput = ob_get_contents();	
	ob_end_clean();	
	$latestOutput = $FormTokenSecure::csrf($latestOutput);
		
<?php
    require "dbinfo.php";
    require "RestService.php";
    require "KnifeCrime.php";

 // Class data
class CrimeDataRestService extends RestService 
{
	private $knifecrimes;
    
	public function __construct() 
	{
		// Passing in the string 'books' to the base constructor ensures that
		// all calls are matched to be sure they are in the form http://server/books/x/y/z 
		parent::__construct("knifecrimes");
	}

	public function performGet($url, $parameters, $requestBody, $accept) 
	{
		switch (count($parameters))
		{
			case 1:
				// Note that we need to specify that we are sending JSON back or
				// the default will be used (which is text/html).
				header('Content-Type: application/json; charset=utf-8');
				// This header is needed to stop IE cacheing the results of the GET	
				header('no-cache,no-store');
				$this->getAllKnifeCrime();
				echo json_encode($this->knifecrimes);
				break;

			case 2:
				// Get specific force data
				$input = $parameters[1];
				if(strpos($input, "force=") !== false)
				{
					header('Content-Type: application/json; charset=utf-8');
					header('no-cache,no-store');
					$force = substr($input, 6);
					$this->getKnifeCrimeByForce($force);
					if ($this->knifecrimes != null)
					{
						echo json_encode($this->knifecrimes);
					}
					else
					{
						$this->notFoundResponse();
					}
					break;
				}
				// Get specific region data
				elseif(strpos($input, "region=") !== false)
				{
					header('Content-Type: application/json; charset=utf-8');
					header('no-cache,no-store');
					$region = substr($input, 7);
					$this->getKnifeCrimeByRegion($region);
					if ($this->knifecrimes != null)
					{
						echo json_encode($this->knifecrimes);
					}
					else
					{
						$this->notFoundResponse();
					}
					break;
				}
				// Get specific year data - Unique results (unique date), no duplicates
				elseif(strpos($input, "year=") !== false)
				{
					header('Content-Type: application/json; charset=utf-8');
					header('no-cache,no-store');
					$year = substr($input, 5);
					$this->getKnifeCrimeByYear($year);
					if ($this->knifecrimes != null)
					{
						echo json_encode($this->knifecrimes);
					}
					else
					{
						$this->notFoundResponse();
					}
					break;
				}
				// Get specific year data - duplicate dates
				elseif(strpos($input, "date=") !== false)
				{
					header('Content-Type: application/json; charset=utf-8');
					header('no-cache,no-store');
					$date = substr($input, 5);
					$this->getKnifeCrimeByDate($date);
					if ($this->knifecrimes != null)
					{
						echo json_encode($this->knifecrimes);
					}
					else
					{
						$this->notFoundResponse();
					}
					break;
				}
				// Get specific id results
				elseif(strpos($input, "id=") !== false)
				{
					header('Content-Type: application/json; charset=utf-8');
					header('no-cache,no-store');
					$Id = substr($input, 3);
					$this->getKnifeCrimeById($Id);
					if ($this->knifecrimes != null)
					{
						echo json_encode($this->knifecrimes);
					}
					else
					{
						$this->notFoundResponse();
					}
					break;
				}
				// Get all regionn results including coordinates
				elseif(strpos($input, "coordinates") !== false)
				{
					header('Content-Type: application/json; charset=utf-8');
					header('no-cache,no-store');
					$this->getAllCoordinatesByRegion();
					if ($this->knifecrimes != null)
					{
						echo json_encode($this->knifecrimes);
					}
					else
					{
						$this->notFoundResponse();
					}
					break;
				}
				// If link incorrect
				else
				{
					$this->notFoundResponse();
				}
			case 3:
				// Parse each link parameter
				$input1 = $parameters[1];
				$input2 = $parameters[2];
				header('Content-Type: application/json; charset=utf-8');
				header('no-cache,no-store');
				// Get specific number of results
				if(strpos($input1, "results") !== false)
				{
					$this->getKnifeCrimeByAmount($input2);
					echo json_encode($this->knifecrimes);
					break;
				}
				// Get results by force and region
				elseif((strpos($input1, "force=") !== false) && (strpos($input2, "region=") !== false))
				{
					$force = substr($input1, 6);
					$region = substr($input2, 7);
					$this->getKnifeCrimeByForceRegion($force, $region);
					echo json_encode($this->knifecrimes);
					break;
				}
				// Get results by force and data
				elseif((strpos($input1, "force=") !== false) && (strpos($input2, "date=") !== false))
				{
					$force = substr($input1, 6);
					$date = substr($input2, 5);
					$this->getKnifeCrimeByForceDate($force, $date);
					echo json_encode($this->knifecrimes);
					break;
				}
				// Get results by region and date
				elseif((strpos($input1, "region=") !== false) && (strpos($input2, "date=") !== false))
				{
					$region = substr($input1, 7);
					$date = substr($input2, 5);
					$this->getKnifeCrimeByRegionDate($region, $date);
					echo json_encode($this->knifecrimes);
					break;
				}
				// Get coordinates from specific region
				elseif((strpos($input1, "coordinates") !== false) && (strpos($input2, "region=") !== false))
				{
					$region = substr($input2, 7);
					$this->getKnifeCrimeRegionCoordinates($region);
					echo json_encode($this->knifecrimes);
					break;
				}
				else
				{
					$this->notFoundResponse();
				}
			
			case 4:
				// Parse each link parameter
				$input1 = $parameters[1];
				$input2 = $parameters[2];
				$input3 = $parameters[3];
				header('Content-Type: application/json; charset=utf-8');
				header('no-cache,no-store');
				// Get results by force, region and date
				if((strpos($input1, "force=") !== false) && (strpos($input2, "region=") !== false) && (strpos($input3, "date=") !== false))
				{
					$force = substr($input1, 6);
					$region = substr($input2, 7);
					$date = substr($input3, 5);
					$this->getKnifeCrimeByForceRegionDate($force, $region, $date);
					echo json_encode($this->knifecrimes);
					break;
				}
				// Get coordinates by region and all dates
				elseif((strpos($input1, "coordinates") !== false) && (strpos($input2, "region=") !== false) && (strpos($input3, "dates") !== false))
				{
					$region = substr($input2, 7);
					$this->getKnifeCrimeRegionDateCoordinates($region);
					echo json_encode($this->knifecrimes);
					break;
				}
				else
				{
					$this->notFoundResponse();
				}
				
			default:	
				$this->methodNotAllowedResponse();

		}
	}

	public function performPut($url, $parameters, $requestBody, $accept) 
	{
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$newCrimeDetail = $this->extractCrimeDetailsFromJSON($requestBody);
		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error)
		{
			// SQL to update database
			$sql = "update knife_crime set date = ?, knifeEnabled = ?, violenceWithInjury = ?, homocideAndSeriousInjury = ?, knifeCrimeTotal = ?
					WHERE crimeID = ?";
			// We pull the fields of the book into local variables since 
			// the parameters to bind_param are passed by reference.
			$statement = $connection->prepare($sql);
			// Class getters
			$crimeId = $newCrimeDetail->getCrimeDetailId();
			$forceId = $newCrimeDetail->getForceName();
			$regionId = $newCrimeDetail->getRegion();
			$date = $newCrimeDetail->getDate();
			$knifeEnabled = $newCrimeDetail->getKnifeEnabled();
			$violenceWithInjury = $newCrimeDetail->getViolenceWithInjury();
			$homocideAndSeriousInjury = $newCrimeDetail->getHomocideAndSeriousInjury();
			$knifeCrimeTotal = $newCrimeDetail->getTotalKnifeCrime();
			// Bind stateent with variables
			$statement->bind_param('siiiii', $date, $knifeEnabled, $violenceWithInjury, $homocideAndSeriousInjury, $knifeCrimeTotal, $crimeId);
			$result = $statement->execute();
			// If results failed
			if ($result == FALSE)
			{
				$errorMessage = $statement->error;
			}
			$statement->close();
			if ($result == TRUE)
			{
				// We need to return the status as 204 (no content) rather than 200 (OK) since
				// we are not returning any data
				$this->noContentResponse();
			}
			else
			{
				$this->errorResponse($errorMessage);
			}

			// Update knife_crime_details database
			$sql2 = "update knife_crime_details set forceID = ?, regionID = ?
					WHERE crimeID = ?";
			$statement = $connection->prepare($sql2);
			$statement->bind_param('iii', $forceId, $regionId, $crimeId);
			$result = $statement->execute();
			if ($result == FALSE)
			{
				$errorMessage = $statement->error;
			}
			$statement->close();
			$connection->close();
			if ($result == TRUE)
			{
				// We need to return the status as 204 (no content) rather than 200 (OK) since
				// we are not returning any data
				$this->noContentResponse();
			}
			else
			{
				$this->errorResponse($errorMessage);
			}
		}
	}

	// KnifeCrimeDetails - get all knife crimes
	private function getAllKnifeCrime()
	{
		// Connect to database 
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		// Connection
		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error)
		{
			// Query
			$query = "SELECT KCD.crimeDetailId, PF.forceName AS forceID, RG.regionName AS regionID, KC.date, KC.knifeEnabled, KC.violenceWithInjury, KC.homocideAndSeriousInjury, KC.knifeCrimeTotal
					  FROM knife_crime_details as KCD JOIN police_force as PF JOIN region as RG JOIN knife_crime as KC
					  ON KCD.forceID = PF.forceID AND KCD.regionID = RG.regionID AND KCD.crimeID = KC.crimeID";
			// If results are returned
			if ($result = $connection->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					$this->knifecrimes[] = new KnifeCrimeDetails($row["crimeDetailId"], $row["forceID"], $row["regionID"], $row["date"], $row["knifeEnabled"], $row["violenceWithInjury"], $row["homocideAndSeriousInjury"], $row["knifeCrimeTotal"]);
				}
				$result->close();
			}
			$connection->close();
		}
	}

	// KnifeCrimeDetails - get specific amount of knifecrime results
	private function getKnifeCrimeByAmount($amount)
	{
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error)
		{
			$query = "SELECT KCD.crimeDetailId, PF.forceName AS forceID, RG.regionName AS regionID, KC.date, KC.knifeEnabled, KC.violenceWithInjury, KC.homocideAndSeriousInjury, KC.knifeCrimeTotal
					  FROM knife_crime_details as KCD JOIN police_force as PF JOIN region as RG JOIN knife_crime as KC
					  ON KCD.forceID = PF.forceID AND KCD.regionID = RG.regionID AND KCD.crimeID = KC.crimeID
					  LIMIT $amount";
			if ($result = $connection->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					$this->knifecrimes[] = new KnifeCrimeDetails($row["crimeDetailId"], $row["forceID"], $row["regionID"], $row["date"], $row["knifeEnabled"], $row["violenceWithInjury"], $row["homocideAndSeriousInjury"], $row["knifeCrimeTotal"]);
				}
				$result->close();
			}
			$connection->close();
		}

	}

	// KnifeCrimeDetails - get all knife crime results by region
	private function getKnifeCrimeByRegion($regionName)
	{
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error)
		{
			$query = "SELECT KCD.crimeDetailId, PF.forceName AS forceID, RG.regionName AS regionID, KC.date, KC.knifeEnabled, KC.violenceWithInjury, KC.homocideAndSeriousInjury, KC.knifeCrimeTotal
					  FROM knife_crime_details as KCD JOIN police_force as PF JOIN region as RG JOIN knife_crime as KC
					  ON KCD.forceID = PF.forceID AND KCD.regionID = RG.regionID AND KCD.crimeID = KC.crimeID
					  WHERE RG.regionName = '$regionName'";
			if ($result = $connection->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					$this->knifecrimes[] = new KnifeCrimeDetails($row["crimeDetailId"], $row["forceID"], $row["regionID"], $row["date"], $row["knifeEnabled"], $row["violenceWithInjury"], $row["homocideAndSeriousInjury"], $row["knifeCrimeTotal"]);
				}
				$result->close();
			}
			$connection->close();
		}
	}

	// KnifeCrimeDetails - get knife crime results by police force
	private function getKnifeCrimeByForce($forceName)
	{
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error)
		{
			$query = "SELECT KCD.crimeDetailId, PF.forceName AS forceID, RG.regionName AS regionID, KC.date, KC.knifeEnabled, KC.violenceWithInjury, KC.homocideAndSeriousInjury, KC.knifeCrimeTotal 
					  FROM knife_crime_details as KCD JOIN police_force as PF JOIN region as RG JOIN knife_crime as KC 
					  ON KCD.forceID = PF.forceID AND KCD.regionID = RG.regionID AND KCD.crimeID = KC.crimeID 
					  WHERE PF.forceName = '$forceName'";
			if ($result = $connection->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					$this->knifecrimes[] = new KnifeCrimeDetails($row["crimeDetailId"], $row["forceID"], $row["regionID"], $row["date"], $row["knifeEnabled"], $row["violenceWithInjury"], $row["homocideAndSeriousInjury"], $row["knifeCrimeTotal"]);
				}
				$result->close();
			}
			$connection->close();
		}
	}

	// KnifeCrimeDetails - get knife crime results by year
	private function getKnifeCrimeByYear($year)
	{
		$year = str_replace("-","/",$year);

		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if(!$connection->connect_error)
		{
			$query = "SELECT KCD.crimeDetailId, PF.forceName AS forceID, RG.regionName AS regionID, KC.date, KC.knifeEnabled, KC.violenceWithInjury, KC.homocideAndSeriousInjury, KC.knifeCrimeTotal 
					  FROM knife_crime_details as KCD JOIN police_force as PF JOIN region as RG JOIN knife_crime as KC 
					  ON KCD.forceID = PF.forceID AND KCD.regionID = RG.regionID AND KCD.crimeID = KC.crimeID 
					  WHERE KC.date = '$year'
			          GROUP BY PF.forceName
			          having count(1) > 1";
			if ($result = $connection->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					$this->knifecrimes[] = new KnifeCrimeDetails($row["crimeDetailId"], $row["forceID"], $row["regionID"], $row["date"], $row["knifeEnabled"], $row["violenceWithInjury"], $row["homocideAndSeriousInjury"], $row["knifeCrimeTotal"]);
				}
				$result->close();
			}
			$connection->close();
		}
	}

	// // KnifeCrimeDetails - get knife crime reuslts by date
	private function getKnifeCrimeByDate($date)
	{
		$year = str_replace("-","/",$date);

		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if(!$connection->connect_error)
		{
			$query = "SELECT KCD.crimeDetailId, PF.forceName AS forceID, RG.regionName AS regionID, KC.date, KC.knifeEnabled, KC.violenceWithInjury, KC.homocideAndSeriousInjury, KC.knifeCrimeTotal 
					  FROM knife_crime_details as KCD JOIN police_force as PF JOIN region as RG JOIN knife_crime as KC 
					  ON KCD.forceID = PF.forceID AND KCD.regionID = RG.regionID AND KCD.crimeID = KC.crimeID 
					  WHERE KC.date = '$year'";
			if ($result = $connection->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					$this->knifecrimes[] = new KnifeCrimeDetails($row["crimeDetailId"], $row["forceID"], $row["regionID"], $row["date"], $row["knifeEnabled"], $row["violenceWithInjury"], $row["homocideAndSeriousInjury"], $row["knifeCrimeTotal"]);
				}
				$result->close();
			}
			$connection->close();
		}
	}

	// KnifeCrimeDetails - get knife crime results by crimeDetailId
	private function getKnifeCrimeById($Id)
	{
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if(!$connection->connect_error)
		{
			$query = "SELECT KCD.crimeDetailId, KC.crimeID, PF.forceName AS forceID, RG.regionName AS regionID, KC.date, KC.knifeEnabled, KC.violenceWithInjury, KC.homocideAndSeriousInjury, KC.knifeCrimeTotal 
					  FROM knife_crime_details as KCD JOIN police_force as PF JOIN region as RG JOIN knife_crime as KC 
					  ON KCD.forceID = PF.forceID AND KCD.regionID = RG.regionID AND KCD.crimeID = KC.crimeID 
					  WHERE KCD.crimeDetailId = '$Id'";
			if ($result = $connection->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					$this->knifecrimes[] = new KnifeCrimeDetailsAndCrimeId($row["crimeDetailId"], $row["crimeID"], $row["forceID"], $row["regionID"], $row["date"], $row["knifeEnabled"], $row["violenceWithInjury"], $row["homocideAndSeriousInjury"], $row["knifeCrimeTotal"]);
				}
				$result->close();
			}
			$connection->close();
		}	
	}

	// KnifeCrimeDetails - get knife crime region results by region
	private function getAllCoordinatesByRegion()
	{
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if(!$connection->connect_error)
		{
			$query = "SELECT regionID as regionId, regionName, regionCoordinates FROM region";
			if ($result = $connection->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					$this->knifecrimes[] = new KnifeCrimeDetailsRegion($row["regionId"], $row["regionName"], $row["regionCoordinates"]);
				}
				$result->close();
			}
			$connection->close();
		}
	}

	// KnifeCrimeDetails - get knife crime results by force and region
	private function getKnifeCrimeByForceRegion($force,$region)
	{
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if(!$connection->connect_error)
		{
			$query = "SELECT KCD.crimeDetailId, PF.forceName AS forceID, RG.regionName AS regionID, KC.date, KC.knifeEnabled, KC.violenceWithInjury, KC.homocideAndSeriousInjury, KC.knifeCrimeTotal
					  FROM knife_crime_details as KCD JOIN police_force as PF JOIN region as RG JOIN knife_crime as KC
					  ON KCD.forceID = PF.forceID AND KCD.regionID = RG.regionID AND KCD.crimeID = KC.crimeID
				      WHERE PF.forceName = '$force' AND RG.regionName = '$region'
					  ORDER BY KC.date ASC";
			if ($result = $connection->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					$this->knifecrimes[] = new KnifeCrimeDetails($row["crimeDetailId"], $row["forceID"], $row["regionID"], $row["date"], $row["knifeEnabled"], $row["violenceWithInjury"], $row["homocideAndSeriousInjury"], $row["knifeCrimeTotal"]);
				}
				$result->close();
			}
			$connection->close();
		}
	}

	// KnifeCrimeDetails - get knife crime results by force and date
	private function getKnifeCrimeByForceDate($force, $date)
	{

		$date = str_replace("-","/",$date);
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if(!$connection->connect_error)
		{
			$query = "SELECT KCD.crimeDetailId, PF.forceName AS forceID, RG.regionName AS regionID, KC.date, KC.knifeEnabled, KC.violenceWithInjury, KC.homocideAndSeriousInjury, KC.knifeCrimeTotal
					  FROM knife_crime_details as KCD JOIN police_force as PF JOIN region as RG JOIN knife_crime as KC
					  ON KCD.forceID = PF.forceID AND KCD.regionID = RG.regionID AND KCD.crimeID = KC.crimeID
				      WHERE PF.forceName = '$force' AND KC.date = '$date'
					  ORDER BY KC.date ASC";
			if ($result = $connection->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					$this->knifecrimes[] = new KnifeCrimeDetails($row["crimeDetailId"], $row["forceID"], $row["regionID"], $row["date"], $row["knifeEnabled"], $row["violenceWithInjury"], $row["homocideAndSeriousInjury"], $row["knifeCrimeTotal"]);
				}
				$result->close();
			}
			$connection->close();
		}
	}

	// KnifeCrimeDetails - get knife crime results by region and date
	private function getKnifeCrimeByRegionDate($region, $date)
	{
		$date = str_replace("-","/",$date);
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if(!$connection->connect_error)
		{
			$query = "SELECT KCD.crimeDetailId, PF.forceName AS forceID, RG.regionName AS regionID, KC.date, KC.knifeEnabled, KC.violenceWithInjury, KC.homocideAndSeriousInjury, KC.knifeCrimeTotal
					  FROM knife_crime_details as KCD JOIN police_force as PF JOIN region as RG JOIN knife_crime as KC
					  ON KCD.forceID = PF.forceID AND KCD.regionID = RG.regionID AND KCD.crimeID = KC.crimeID
				      WHERE RG.regionName = '$region' AND KC.date = '$date'
					  ORDER BY KC.date ASC";
			if ($result = $connection->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					$this->knifecrimes[] = new KnifeCrimeDetails($row["crimeDetailId"], $row["forceID"], $row["regionID"], $row["date"], $row["knifeEnabled"], $row["violenceWithInjury"], $row["homocideAndSeriousInjury"], $row["knifeCrimeTotal"]);
				}
				$result->close();
			}
			$connection->close();
		}
	}

	// KnifeCrimeDetails - get knife crime coordinates by region
	private function getKnifeCrimeRegionCoordinates($region)
	{
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if(!$connection->connect_error)
		{
			$query = "SELECT regionCoordinates FROM region WHERE regionName='$region'";
			if ($result = $connection->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					$this->knifecrimes[] = $row["regionCoordinates"];
				}
				$result->close();
			}
			$connection->close();
		}
	}

	// KnifeCrimeDetails - get knife crime results by region - unique results by date
	private function getKnifeCrimeRegionDateCoordinates($region)
	{
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if(!$connection->connect_error)
		{
			$query = "SELECT KCD.crimeDetailId, PF.forceName AS forceID, RG.regionName AS regionID, KC.date, KC.knifeEnabled, KC.violenceWithInjury, KC.homocideAndSeriousInjury, KC.knifeCrimeTotal 
					 FROM knife_crime_details as KCD JOIN police_force as PF JOIN region as RG JOIN knife_crime as KC 
					 ON KCD.forceID = PF.forceID AND KCD.regionID = RG.regionID AND KCD.crimeID = KC.crimeID 
					 WHERE RG.regionName = '$region'
					 GROUP BY PF.forceName, RG.regionName, KC.date
					 having count(1) > 1
					 ORDER BY PF.forceName, KC.date ASC";
			if ($result = $connection->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					$this->knifecrimes[] = new KnifeCrimeDetails($row["crimeDetailId"], $row["forceID"], $row["regionID"], $row["date"], $row["knifeEnabled"], $row["violenceWithInjury"], $row["homocideAndSeriousInjury"], $row["knifeCrimeTotal"]);
				}
				$result->close();
			}
			$connection->close();
		}
	}

	// KnifeCrimeDetails - get knife crime results by force, region and date
	private function getKnifeCrimeByForceRegionDate($force, $region, $date)
	{
		$date = str_replace("-","/",$date);
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if(!$connection->connect_error)
		{
			$query = "SELECT KCD.crimeDetailId, PF.forceName AS forceID, RG.regionName AS regionID, KC.date, KC.knifeEnabled, KC.violenceWithInjury, KC.homocideAndSeriousInjury, KC.knifeCrimeTotal
					  FROM knife_crime_details as KCD JOIN police_force as PF JOIN region as RG JOIN knife_crime as KC
					  ON KCD.forceID = PF.forceID AND KCD.regionID = RG.regionID AND KCD.crimeID = KC.crimeID
				      WHERE PF.forceName = '$force' AND RG.regionName = '$region' AND KC.date = '$date'
					  ORDER BY KC.date ASC";
			if ($result = $connection->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					$this->knifecrimes[] = new KnifeCrimeDetails($row["crimeDetailId"], $row["forceID"], $row["regionID"], $row["date"], $row["knifeEnabled"], $row["violenceWithInjury"], $row["homocideAndSeriousInjury"], $row["knifeCrimeTotal"]);
				}
				$result->close();
			}
			$connection->close();
		}
	}

	// KnifeCrimeDetails - PUT request - decode JSON
	private function extractCrimeDetailsFromJSON($requestBody)
	{
		$crimeDetailArray = json_decode($requestBody, true);
		$knifeCrime = new KnifeCrimeDetails($crimeDetailArray["CrimeDetailId"],
											$crimeDetailArray["ForceName"],
											$crimeDetailArray["Region"],
											$crimeDetailArray["Date"],
											$crimeDetailArray["KnifeEnabled"],
											$crimeDetailArray["ViolenceWithInjury"],
											$crimeDetailArray["HomocideAndSeriousInjury"],
											$crimeDetailArray["TotalKnifeCrime"]);
		unset($crimeDetailArray);
		return $knifeCrime;
	}

}
?>

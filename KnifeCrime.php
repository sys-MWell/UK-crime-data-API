<?php
class KnifeCrimeDetails
{
    public $CrimeDetailId;
    public $ForceName;
    public $Region;
    public $Date;
    public $KnifeEnabled;
    public $ViolenceWithInjury;
    public $HomocideAndSeriousInjury;
    public $TotalKnifeCrime;

    public function __construct($crimedetailid, $forcename, $region, $date, $knifenabled, $violencewithinjury, $homocideandseriousinjury, $totalknifecrime)
    {
        $this->CrimeDetailId = $crimedetailid;
        $this->ForceName = $forcename;
        $this->Region = $region;
        $this->Date = $date;
        $this->KnifeEnabled = $knifenabled;
        $this->ViolenceWithInjury = $violencewithinjury;
        $this->HomocideAndSeriousInjury = $homocideandseriousinjury;
        $this->TotalKnifeCrime = $totalknifecrime;
    }

    public function getCrimeDetailId()
    {
        return $this->CrimeDetailId;
    }

    public function getForceName()
    {
        return $this->ForceName;
    }

    public function getRegion()
    {
        return $this->Region;
    }

    public function getDate()
    {
        return $this->Date;
    }

    public function getKnifeEnabled()
    {
        return $this->KnifeEnabled;
    }

    public function getViolenceWithInjury()
    {
        return $this->ViolenceWithInjury;
    }

    public function getHomocideAndSeriousInjury()
    {
        return $this->HomocideAndSeriousInjury;
    }

    public function getTotalKnifeCrime()
    {
        return $this->TotalKnifeCrime;
    }

}

class KnifeCrimeDetailsAndCrimeId
{
    public $CrimeDetailId;
    public $CrimeId;
    public $ForceName;
    public $Region;
    public $Date;
    public $KnifeEnabled;
    public $ViolenceWithInjury;
    public $HomocideAndSeriousInjury;
    public $TotalKnifeCrime;

    public function __construct($crimedetailid, $crimeid, $forcename, $region, $date, $knifenabled, $violencewithinjury, $homocideandseriousinjury, $totalknifecrime)
    {
        $this->CrimeDetailId = $crimedetailid;
        $this->CrimeId = $crimeid;
        $this->ForceName = $forcename;
        $this->Region = $region;
        $this->Date = $date;
        $this->KnifeEnabled = $knifenabled;
        $this->ViolenceWithInjury = $violencewithinjury;
        $this->HomocideAndSeriousInjury = $homocideandseriousinjury;
        $this->TotalKnifeCrime = $totalknifecrime;
    }
}

class KnifeCrimeDetailsRegion
{
    public $RegionId;
    public $RegionName;
    public $RegionCoordinates;
    public function __construct($regionid, $regionname, $regioncoordinates)
    {
        $this->RegionId = $regionid;
        $this->RegionName = $regionname;
        $this->RegionCoordinates = $regioncoordinates;
    }
}

?>

<?php

class AgencyModel extends Database
{
    const TABLE_AGENCY = 'tbl_agency';

    public function addAgencyNew($dataAgency)
    {
        return $this->insert(self::TABLE_AGENCY, $dataAgency);
    }
}
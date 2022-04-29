<?php
include_once(__DIR__.'/../database.php');
include_once(__DIR__.'/donation.php');

class Invite {
    public int $invite_id;
    public int $campaign_id;
    public string $creation_date;
    public string $start_date;
    public string $end_date;
    public bool $requires_verification;
    public string $optional_password_hash;
    public int $donation_limit;
    public int $created_by_user_id;
    public string $name;

    public static function getByID($invite_id){
        global $query;
        $query->table("Invite")
            ->select()
            ->where("invite_id", $invite_id)
            ->get();
        if(isset($data[0])) return new Invite($data[0]);
        else return null;
    }

    public static function getAllByCampaignID($campaign_id){
        global $query;
        $data = $query->table("Invite")
            ->select()
            ->where("campaign_id", $campaign_id)
            ->get();
        return array_map(function($row){
            return new Invite($row);
        }, $data);
    }

    function __construct($data){
        $this->campaign_id = (int)$data["campaign_id"] ?? null;
        $this->creation_date = $data["creation_date"] ?? date('c', time());
        $this->start_date = $data["start_date"] ?? date('c', time());
        $this->end_date = $data["start_date"] ?? null;
        $this->requires_verification = true; // TODO: revisar
        $this->created_by_user_id = (int)$data["created_by_user_id"] ?? -1;
        $this->donation_limit = (int)$data["donation_limit"] ?? 0;
        $this->optional_password_hash = $data["optional_password_hash"];
        $this->name = $data["name"];
        if(isset($data["invite_id"])) $this->invite_id = (int)$data["invite_id"] ?? null;
    }

    public function upload_new(){
        global $query;
        $query->table("Invite")
            ->insert([
                (array)$this
            ])
            ->execute();
    }

    public function update(){
        global $query;
        $query->table("Invite")
            ->update()
                ->set("start_date", $this->start_date)
                ->set("end_date", $this->end_date)
                ->set("requires_verification", $this->requires_verification)
                ->set("donation_limit", $this->donation_limit)
                ->set("name", $this->name)
                ->set("optional_password_hash", $this->optional_password_hash)
            ->where("invite_id", $this->invite_id)
            ->execute();
    }

    public function countDonations(){
        global $query;
        $data = $query->table("view_InviteDonationCount")
            ->select()
            ->where("invite_id", $this->invite_id)
            ->get();
        if(isset($data[0])) return $data[0]["count"];
        else return null;
    }

    public function getDonations(){
        return Donation::getAllByInviteID($this->invite_id);
    }

    public function getVerifiedDonations(){
        return array_filter(Donation::getAllByInviteID($this->invite_id), function($row){
            return $row->verified == true;
        });
    }

    function addDonation($donation_data){
        // Check max donations
        if( $this->countDonations() >= $this->donation_limit ) return;
        // TODO: check time period
        // Else create donation
        $donation_data["campaign_id"] = $this->campaign_id;
        $donation_data["invite_id"] = $this->invite_id;
        $donation = new Donation($donation_data);
        $donation->upload_new();
    }

}

?>
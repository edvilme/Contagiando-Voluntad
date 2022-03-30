<?php

include_once(__DIR__.'/../database.php');
include_once(__DIR__.'/donation.php');
include_once(__DIR__.'/invite.php');


class Campaign {
    public ?int $campaign_id;
    public string $name;
    public string $description;
    public ?string $start_date;
    public ?string $end_date;
    public string $creation_date;
    public string $promotional_picture_url;
    public string $badge_picture_url;
    public bool $is_public;
    public int $created_by_user_id;

    static function getAll(){
        global $query;
        $data = $query->table("Campaign")
            ->select()
            ->get();
        return array_map(function($row){
            return new Campaign($row);
        }, $data);
    }

    static function getByID($campaign_id){
        global $query;
        $data = $query->table("Campaign")
            ->select()
            ->where("campaign_id", $campaign_id)
            ->get();
        if(isset($data[0])) return new Campaign($data[0]);
        else return null;
    }


    function __construct($data){
        $this->name = $data["name"];
        $this->description = $data["description"];
        $this->start_date = $data["start_date"] ?? null;
        $this->end_date = $data["end_date"] ?? null;
        $this->creation_date = $data["creation_date"] ??  date('c', time());
        $this->promotional_picture_url = $data["promotional_picture_url"];
        $this->badge_picture_url = $data["badge_picture_url"];

        $this->is_public = (bool)$data["is_public"] ?? true;
        $this->campaign_id = (int)$data["campaign_id"] ?? null;
        $this->created_by_user_id = (int)$data["created_by_user_id"] ?? -1;
    }

    public function upload_new(){
        global $query;
        $query->table("Campaign")
            ->insert([
                (array)$this
            ])
            ->execute();
    }

    public function update(){
        global $query;
        $query->table("Campaign")
            ->update()
                ->set("name", $this->name)
                ->set("description", $this->description)
                ->set("start_date", $this->start_date)
                ->set("end_date", $this->end_date)
                ->set("creation_date", $this->creation_date)
                ->set("promotional_picture_url", $this->promotional_picture_url)
                ->set("is_public", $this->is_public)
            ->where("campaign_id", $this->campaign_id)
            ->execute();
    }

    public function getItems(){
        return CampaignItem::getAllByCampaignID($this->campaign_id);
    }

    public function addItem($item_data){
        $item_data["campaign_id"] = $this->campaign_id;
        $item = new CampaignItem($item_data);
        $item->upload_new();
    }

    public function getDonations(){
        return Donation::getAllByCampaignID($this->campaign_id);
    }

    public function getVerifiedDonations(){
        return array_filter(Donation::getAllByCampaignID($this->campaign_id), function($row){
            return $row->verified == true;
        });
    }

    public function addDonation($donation_data){
        // TODO: check time period 
            // Solo los admins pueden registrar donaciones fuera del rango de tiempo
        $donation_data["campaign_id"] = $this->campaign_id;
        $donation = new Donation($donation_data);
        $donation->upload_new();
    }

    public function getInvites(){
        return Invite::getAllByCampaignID($this->campaign_id);
    }

    public function addInvite($invite_data){
        $invite_data["campaign_id"] = $this->campaign_id;
        $invite = new Invite($invite_data);
        $invite->upload_new();
    }

}

class CampaignItem {
    public ?int $campaign_item_id;
    public ?int $campaign_id;
    public string $type; // item or recipient
    public string $name;
    public string $description;
    public string $photo_url;

    public static function getById($campaign_item_id){
        global $query;
        $data = $query->table("CampaignItem")
            ->select()
            ->where("campaign_item_id", $campaign_item_id)
            ->get();
        if(isset($data[0])) return new CampaignItem(($data[0]));
        else return null;
    }

    public static function getAllByCampaignID($campaign_id){
        global $query;
        $data = $query->table("CampaignItem")
            ->select()
            ->where("campaign_id", $campaign_id)
            ->get();
        return array_map(function ($row){
            return new CampaignItem($row);
        }, $data);
    }

    function __construct($data){
        $this->campaign_item_id = (int)($data["campaign_item_id"] ?? null);
        $this->campaign_id = (int)($data["campaign_id"] ?? null);
        $this->type = $data["type"] ?? "item";
        $this->description = $data["description"];
        $this->photo_url = $data["photo_url"];
        $this->name = $data["name"];
    }

    public function upload_new(){
        global $query;
        $query->table("CampaignItem")
            ->insert([
                (array)$this
            ])
            ->execute();
    }

    public function update(){
        global $query;
        $query->table("CampaignItem")
            ->update()
                ->set("type", $this->type)
                ->set("name", $this->name)
                ->set("description", $this->description)
                ->set("photo_url", $this->photo_url)
            ->where("campaign_item_id", $this->campaign_item_id)
            ->execute();
    }

}

?>
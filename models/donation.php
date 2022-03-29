<?php

class Donation {
    public ?int $donation_id;

    public ?int $campaign_id;
    public ?int $invite_id;
    public ?int $donor_id;

    public ?int $recipient_id;
    public ?int $item_id;

    public string $type;
    public string $concept;
    public string $description;
    public string $attachment_urls;
    public string $date;

    public bool $is_validated;


    public static function getByID($donation_id){
        global $query;
        $data = $query->table("Donation")
            ->select()
            ->where("donation_id", $donation_id)
            ->get();
        if(isset($data[0])) return new Donation($data[0]);
        else return null;
    }

    public static function getAllByCampaignID($campaign_id){
        global $query;
        $data = $query->table("Donation")
            ->select()
            ->where("campaign_id", $campaign_id)
            ->get();
        return array_map(function ($row){
            return new Donation($row);
        }, $data);
    }

    public static function getAllByInviteID($invite_id){
        global $query;
        $data = $query->table("Donation")
            ->select()
            ->where("invite_id", $invite_id)
            ->get();
        return array_map(function ($row){
            return new Donation($row);
        }, $data);
    }

    public static function getAllByDonorID($donor_id){
        global $query;
        $data = $query->table("Donation")
            ->select()
            ->where("donor_id", $donor_id)
            ->get();
        return array_map(function ($row){
            return new Donation($row);
        }, $data);
    }

    function __construct($data){
        $this->donation_id = (int)$data["donation_id"] ?? null;
        $this->campaign_id = (int)$data["campaign_id"] ?? null;
        $this->invite_id = (int)$data["invite_id"] ?? -1;
        $this->donor_id = (int)$data["donor_id"] ?? -1;
        $this->recipient_id = (int)$data["recipient_id"] ?? -1;
        $this->item_id = (int)$data["item_id"] ?? -1;

        $this->type = $data["type"] ?? "money";
        $this->concept = $data["concept"];
        $this->description = $data["description"];
        $this->attachment_urls = $data["attachment_urls"];
        $this->date = $data["date"] ?? date('c', time());

        $this->validated = (bool)$data["is_validated"] ?? false;
    }

    public function upload_new(){
        global $query;
        $query->table("Donation")
            ->insert([
                (array)$this
            ])
            ->execute();
    }

    public function update(){
        global $query;
        $query->table("Donation")
            ->update()
                ->set("recipient_id", $this->recipient_id)
                ->set("item_id", $this->item_id)
                ->set("type", $this->type)
                ->set("concept", $this->concept)
                ->set("description", $this->description)
                ->set("attachment_urls", $this->attachment_urls)
                ->set("date", $this->date)
                ->set("validated", $this->validated)
            ->where("donation_id", $this->donation_id)
            ->execute();
    }

}

?>
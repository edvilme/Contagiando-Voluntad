<?php

include_once(__DIR__.'/../database.php');

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
}

?>
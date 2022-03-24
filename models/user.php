<?php
    include_once(__DIR__.'/../database.php');

    class User{
        public static function getByID($user_id){
            global $query;
            $data = $query->table("User")
                ->select()
                ->where("user_id", $user_id)
                ->get();
            return new User($data[0]);
        }


        public ?int $user_id;
        public string $name;
        public ?string $last_name;
        public string $email;
        public ?string $telephone;
        public ?string $location;
        public ?string $birthdate;
        public string $password_hash;
        public ?string $profile_picture_url;
        public string $creation_date;
        public string $type;
        public int $business_id;

        function __construct($data){
            $this->name = $data["name"];
            $this->last_name = $data["last_name"];
            $this->email = $data["email"];
            $this->tel = $data["tel"] ?? "";
            $this->location = $data["location"];
            $this->birthdate = $data["birthdate"];
            $this->password_hash = $data["password_hash"];
            $this->profile_picture_url = $data["profile_picture_url"] ?? null;
            $this->creation_date = $data["creation_date"] ?? date('c', time());
            $this->type = $data["type"] ?? "user";
            
            if(isset($data["user_id"])) $this->user_id = (int)$data["user_id"] ?? null;
            if(isset($data["business_id"])) $this->business_id = (int)$data["business_id"] ?? -1;
        }

        public function upload_new(){
            global $query;
            $query->table("User")
                ->insert([
                    (array)$this
                ])
                ->execute();
        }

        

    }
?>
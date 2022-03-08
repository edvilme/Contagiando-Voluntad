<?php
    include "../database.php";

    class User{
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
            $this->user_id = $data["user_id"] ?? null;
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
            $this->business_id = $data["business_id"] ?? -1;
        }

        function upload_new(){
            global $database;
            $q = $database->prepare("
                INSERT INTO User (name, last_name, email, tel, location, birthdate, password_hash, profile_picture_url, creation_date, type, business_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $q->bind_param("ssssssssssi", $this->name, $this->last_name, $this->email, $this->tel, $this->location, $this->birthdate, $this->password_hash, $this->profile_picture_url, $this->creation_date, $this->type, $this->business_id);
            $q->execute();
        }

        function update(){
            global $database;
        }

        static function get_one($user_id){
            global $database;
            $q = $database->prepare("SELECT * FROM User WHERE user_id = ?");
            $q->bind_param("i", $user_id);
            $q->execute();

            $result = $q->get_result();
            $user = $result->fetch_assoc();
            return new User($user);
        }
    }
?>
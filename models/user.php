<?php

use function PHPSTORM_META\map;

    include_once(__DIR__.'/../database.php');
    include_once(__DIR__.'/donation.php');

    class User{

        public static function getAll(){
            global $query;
            $data = $query->table("User")
                ->select()
                ->get();
            return array_map(function($user){
                return new User($user);
            }, $data);
        }

        public static function getByID($user_id){
            global $query;
            $data = $query->table("User")
                ->select()
                ->where("user_id", $user_id)
                ->get();
            if(isset($data[0])) return new User($data[0]);
            else return null;
        }

        public static function getByEmail($email){
            global $query;
            $data = $query->table("User")
                ->select()
                ->where("email", $email)
                ->get();
            if(isset($data[0])) return new User($data[0]);
            else return null;
        }

        public static function getByEmailAndPassword($email, $password){
            global $query;
            $data = $query->table("User")
                ->select()
                ->where("email", $email)
                ->where("password_hash", $password)
                ->get();
            if(isset($data[0])) return new User($data[0]);
            else return null;
        }

        public static function search($q){
            global $query;
            global $database;

            $data = $database->query("CALL searchUsers('.$q.')");
            /* return array_map(function($item){
                return new User($item);
            }, $data); */
            return $data;

        }

        public ?int $user_id;
        public string $name;
        public ?string $last_name;
        public string $email;
        public ?string $tel;
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
            $this->profile_picture_url = $data["profile_picture_url"] ?? "";
            $this->creation_date = $data["creation_date"] ?? date('c', time());
            $this->type = $data["type"] ?? "user";
            
            if(isset($data["user_id"])) $this->user_id = (int)($data["user_id"] ?? null);
            if(isset($data["business_id"])) $this->business_id = (int)($data["business_id"] ?? -1);
        }

        public function upload_new(){
            global $query;
            $query->table("User")
                ->insert([
                    (array)$this
                ])
                ->execute();
        }

        public function update(){
            global $query;
            $query->table("User")
                ->update()
                    ->set("name", $this->name)
                    ->set("last_name", $this->last_name)
                    ->set("tel", $this->tel)
                    ->set("location", $this->location)
                    ->set("birthdate", $this->birthdate)
                    ->set("password_hash", $this->password_hash)
                    ->set("profile_picture_url", $this->profile_picture_url)
                    ->set("type", $this->type) // TODO: revisar
                ->where("user_id", $this->user_id)
                ->execute();
        }

        public function getDonations(){
            return Donation::getAllByDonorID($this->user_id);
        }

        public function getVerifiedDonations(){
            return array_filter(Donation::getAllByDonorID($this->user_id), function($row){
                return $row->verified == true;
            });
        }
        
    }
?>
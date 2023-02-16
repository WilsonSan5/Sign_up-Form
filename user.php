<?php

class user
{
    var $user_id;
    var $user_email;
    private $user_password;
    var $status;

    // Construct
    function __construct($id, $email, $password, $status)
    {
        $this->set_id($id);
        $this->set_email($email);
        $this->set_password($password);
        $this->set_status($status);
    }
    // Méthodes d'appel
    public function get_id()
    {
        return $this->user_id;
    }
    public function get_email()
    {
        return $this->user_email;
    }
    public function get_status()
    {
        return $this->status;
    }
    // Méthodes de modification
    private function set_id($id)
    {
        $this->user_id = $id;
    }
    public function set_email($newEmail)
    {
        $this->user_email = $newEmail;
    }
    public function set_status($newStatus)
    {
        $this->status = $newStatus;
    }
    public function set_password($newPassword)
    {
        $this->user_password = $newPassword;
    }
}

?>
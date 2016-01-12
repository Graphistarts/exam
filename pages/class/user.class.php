<?php

class User {
    protected $username;
    protected $isConnected;
    protected $isAdmin;


    // GETTERS AND SETTERS
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getIsConnected()
    {
        return $this->isConnected;
    }

    /**
     * @param mixed $isConnected
     */
    public function setIsConnected($isConnected)
    {
        $this->isConnected = $isConnected;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param mixed $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }



}

?>
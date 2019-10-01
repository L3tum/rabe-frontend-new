<?php

/**
 * Class User
 */
class User
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var bool
     */
    public $blocked;

    /**
     * @var bool
     */
    public $admin;

    /**
     * @var bool
     */
    public $passwordChanged;

    /**
     * @var string
     */
    public $token;

    /**
     * @var bool
     */
    public $isAuthenticated;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBlocked(): bool
    {
        return $this->blocked;
    }

    /**
     * @param bool $blocked
     * @return User
     */
    public function setBlocked(bool $blocked): User
    {
        $this->blocked = $blocked;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->admin;
    }

    /**
     * @param bool $admin
     * @return User
     */
    public function setAdmin(bool $admin): User
    {
        $this->admin = $admin;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPasswordChanged(): bool
    {
        return $this->passwordChanged;
    }

    /**
     * @param bool $passwordChanged
     * @return User
     */
    public function setPasswordChanged(bool $passwordChanged): User
    {
        $this->passwordChanged = $passwordChanged;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return User
     */
    public function setToken(string $token): User
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return $this->isAuthenticated;
    }

    /**
     * @param bool $isAuthenticated
     * @return User
     */
    public function setIsAuthenticated(bool $isAuthenticated): User
    {
        $this->isAuthenticated = $isAuthenticated;
        return $this;
    }
}

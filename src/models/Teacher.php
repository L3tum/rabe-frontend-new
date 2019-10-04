<?php

namespace RaBe\Models;

/**
 * Class Teacher
 */
class Teacher
{
    /**
     * @var int|null
     */
    public $id;

    /**
     * @var string|null
     */
    public $name;

    /**
     * @var string|null
     */
    public $email;

    /**
     * @var bool
     */
    public $blocked = false;

    /**
     * @var bool
     */
    public $administrator = false;

    /**
     * @var bool
     */
    public $passwordGeaendert = false;

    /**
     * @var string|null
     */
    public $token;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Teacher
     */
    public function setId(?int $id): Teacher
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Teacher
     */
    public function setName(?string $name): Teacher
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Teacher
     */
    public function setEmail(?string $email): Teacher
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
     * @return Teacher
     */
    public function setBlocked(bool $blocked): Teacher
    {
        $this->blocked = $blocked;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAdministrator(): bool
    {
        return $this->administrator;
    }

    /**
     * @param bool $administrator
     * @return Teacher
     */
    public function setAdministrator(bool $administrator): Teacher
    {
        $this->administrator = $administrator;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPasswordGeaendert(): bool
    {
        return $this->passwordGeaendert;
    }

    /**
     * @param bool $passwordGeaendert
     * @return Teacher
     */
    public function setPasswordGeaendert(bool $passwordGeaendert): Teacher
    {
        $this->passwordGeaendert = $passwordGeaendert;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     * @return Teacher
     */
    public function setToken(?string $token): Teacher
    {
        $this->token = $token;
        return $this;
    }
}
